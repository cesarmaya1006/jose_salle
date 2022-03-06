<?php

namespace App\Http\Controllers\Intranet\Funcionarios;

use App\Http\Controllers\Controller;
use App\Models\Tutela\AnexoPrimeraInstancia;
use App\Models\Tutela\AutoAdmisorio;
use App\Models\Tutela\Impugnacion;
use App\Models\Tutela\ImpugnacionResuelve;
use App\Models\Tutela\PrimeraInstancia;
use App\Models\Tutela\ResuelvePrimeraInstancia;
use App\Models\Tutela\TipoAccion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use DateTime;

class TutelasConsulta extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('intranet.funcionarios.tutela.consulta.index');
    }

    public function cargar_tutelas(Request $request)
    {
        if ($request->ajax()) {
            if ($request['tipoBusqueda'] == 'Número de radicado') {
                return AutoAdmisorio::where('radicado', 'like', '%' . $request['numRadicado'] . '%')->with('accions')->with('accions.tipos_docu_accion')->orderByDesc('fecha_radicado')->get();
            } elseif ($request['tipoBusqueda'] == 'Nombre o apellido del accionante') {
                $nombreApellidos = $request['nombreApellidos'];
                return AutoAdmisorio::with('accions')->with('accions.tipos_docu_accion')->whereHas('accions', function ($q) use ($nombreApellidos) {
                    $q->where('nombres_accion', 'like', '%' . $nombreApellidos . '%')->orWhere('apellidos_accion', 'like', '%' . $nombreApellidos . '%');
                })->orderByDesc('fecha_radicado')->get();
            } else {
                $tipoDoc = $request['tipoDoc'];
                $numDocumento = $request['numDocumento'];
                return AutoAdmisorio::with('accions')->with('accions.tipos_docu_accion')->whereHas('accions', function ($q) use ($tipoDoc, $numDocumento) {
                    $q->where('numero_documento_accion', 'like', '%' . $numDocumento . '%')->whereHas('tipos_docu_accion', function ($p) use ($tipoDoc) {
                        $p->where('id', $tipoDoc);
                    });
                })->orderByDesc('fecha_radicado')->get();
            }
        }
    }
    public function detalles_tutelas($id)
    {
        $tutela = AutoAdmisorio::findOrFail($id);
        return view('intranet.funcionarios.tutela.consulta.detalles', compact('tutela'));
    }
    public function tutelas_primera_instancia($id)
    {
        $tutela = AutoAdmisorio::findOrFail($id);
        return view('intranet.funcionarios.tutela.sentenciap.index', compact('tutela'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tutelas_primera_instancia_guardar(Request $request, $id)
    {
        if ($request['formaCarga'] == 'detalle') {
            $sentenciapinstancia['auto_admisorio_id'] = $id;
            $sentenciapinstancia['fecha_sentencia'] = $request['fecha_sentencia'];
            $sentenciapinstancia['fecha_notificacion'] = $request['fecha_notificacion'] . ' ' . $request['hora_notificacion'];
            $sentenciapinstancia['sentencia'] = $request['sentencia'];
            //------------------------------------------
            if ($request->hasFile('url_sentencia')) {
                $ruta = Config::get('constantes.folder_sentencias');
                $ruta = trim($ruta);
                $doc_subido = $request->url_sentencia;
                $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
                $sentenciapinstancia['url_sentencia'] = $nombre_doc;
                $doc_subido->move($ruta, $nombre_doc);
            }
            //------------------------------------------
            $nuevasentenciapinstancia = PrimeraInstancia::create($sentenciapinstancia);
            //------------------------------------------
            if (intval($request['cantAdjuntos']) > 0) {
                $cantAdjuntos = intval($request['cantAdjuntos']);
                for ($i = 1; $i <= $cantAdjuntos; $i++) {
                    $newAnexoSentencia['sentenciapinstancia_id'] = $nuevasentenciapinstancia->id;
                    $newAnexoSentencia['titulo_anexo'] = $request['titulo_anexo' . $i];
                    $newAnexoSentencia['descripcion_anexo'] = $request['descripcion_anexo' . $i];
                    //------------------------------------------
                    if ($request->hasFile('url_anexo' . $i)) {
                        $ruta = Config::get('constantes.folder_sentencias');
                        $ruta = trim($ruta);
                        $doc_subido = $request['url_anexo' . $i];
                        $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
                        $newAnexoSentencia['url_anexo'] = $nombre_doc;
                        $doc_subido->move($ruta, $nombre_doc);
                    }
                    //------------------------------------------
                    AnexoPrimeraInstancia::create($newAnexoSentencia);
                }
            }
            //------------------------------------------
            if (intval($request['catnResuelves']) > 0) {
                $catnResuelves = intval($request['catnResuelves']);
                for ($i = 1; $i <= $catnResuelves; $i++) {
                    $newResuelve['sentenciapinstancia_id'] = $nuevasentenciapinstancia->id;
                    $newResuelve['sentido'] = $request['sentido' . $i];
                    $newResuelve['numeracion'] = $request['numeracion' . $i];
                    $newResuelve['resuelve'] = $request['resuelve' . $i];
                    $newResuelve['dias'] = $request['dias' . $i];
                    $newResuelve['horas'] = $request['horas' . $i];
                    //------------------------------------------
                    ResuelvePrimeraInstancia::create($newResuelve);
                }
            }
            return redirect('funcionario/consulta/detalles_tutelas/' . $id)->with('mensaje', 'Registro de primera instancia con exito.');
        } else {
            $sentenciapinstancia['auto_admisorio_id'] = $id;
            $sentenciapinstancia['fecha_sentencia'] = $request['fecha_sentencia'];
            $sentenciapinstancia['fecha_notificacion'] = $request['fecha_notificacion'] . ' ' . $request['hora_notificacion'];
            $sentenciapinstancia['sentencia'] = $request['sentencia'];
            //------------------------------------------
            if ($request->hasFile('url_sentencia')) {
                $ruta = Config::get('constantes.folder_sentencias');
                $ruta = trim($ruta);
                $doc_subido = $request->url_sentencia;
                $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
                $sentenciapinstancia['url_sentencia'] = $nombre_doc;
                $doc_subido->move($ruta, $nombre_doc);
            }
            //------------------------------------------
            $nuevasentenciapinstancia = PrimeraInstancia::create($sentenciapinstancia);
            //------------------------------------------
            if (intval($request['cantResuelves']) > 0) {
                $cantResuelves = intval($request['cantResuelves']);
                for ($i = 1; $i <= $cantResuelves; $i++) {
                    $newResuelve['sentenciapinstancia_id'] = $nuevasentenciapinstancia->id;
                    $newResuelve['sentido'] = $request['sentido' . $i];
                    $newResuelve['numeracion'] =  $i;
                    $newResuelve['dias'] = $request['diascant' . $i];
                    $newResuelve['horas'] = $request['horascant' . $i];
                    //------------------------------------------
                    ResuelvePrimeraInstancia::create($newResuelve);
                }
            }
            return redirect('funcionario/consulta/detalles_tutelas/' . $id)->with('mensaje', 'Registro de primera instancia con exito.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tutelas_impugnacion($id)
    {
        $tutela = AutoAdmisorio::findOrFail($id);
        return view('intranet.funcionarios.tutela.impugnacion.index', compact('tutela'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tutelas_impugnacion_gestion($id)
    {
        $tutela = AutoAdmisorio::findOrFail($id);
        return view('intranet.funcionarios.tutela.impugnacion.gestionar.index', compact('tutela'));
    }

    public function tutelas_impugnacion_registro($id)
    {
        $tipo_accion = TipoAccion::get();
        $tutela = AutoAdmisorio::findOrFail($id);
        return view('intranet.funcionarios.tutela.impugnacion.registrar.index', compact('tutela', 'tipo_accion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tutelas_impugnacion_guardar(Request $request, $id)
    {
        if ($request->ajax()) {

            $tutela = AutoAdmisorio::findOrFail($id);
            foreach ($tutela->primeraInstancia as $primeraInstancia) {

                $firstDate = new DateTime($primeraInstancia->fecha_notificacion);
                $secondDate = new DateTime(date('d-m-Y', strtotime($primeraInstancia->fecha_notificacion . '+ 3 days')));
                $intvl = $firstDate->diff($secondDate);
                if ($intvl->days > 3) {
                    $impugnacion_estado_id = 2;
                } else {
                    $impugnacion_estado_id = 1;
                }
                if ($primeraInstancia->impugnaciones->count() > 0) {
                    $impugnacionUpdate['impugnacion_estado_id'] = $impugnacion_estado_id;
                    foreach ($primeraInstancia->impugnaciones as $impugnacionn) {
                        $idImpugnacion = $impugnacionn;
                    }
                    Impugnacion::findOrFail($idImpugnacion->id)->update($impugnacionUpdate);
                    $impugnacion = Impugnacion::findOrFail($idImpugnacion->id);
                } else {
                    $impugnacionNueva['sentenciapinstancia_id'] = $primeraInstancia->id;
                    $impugnacionNueva['impugnacion_estado_id'] = $impugnacion_estado_id;
                    $impugnacionNueva['fecha'] = Carbon::now();
                    $impugnacion = Impugnacion::create($impugnacionNueva);
                }

                $impugnacionResuelveNueva['impugnacion_id'] = $impugnacion->id;
                $impugnacionResuelveNueva['impugnacionresuelve_estado_id'] = 7;
                $impugnacionResuelveNueva['resuelve'] = $request->resuelve;
                if ($request->hasFile('url_sentencia')) {
                    $ruta = Config::get('constantes.folder_sentencias');
                    $ruta = trim($ruta);
                    $doc_subido = $request->url_sentencia;
                    $nombre_doc = str_replace(' ', '', time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName())));
                    $impugnacionResuelveNueva['url_impugnacion'] = $nombre_doc;
                    $doc_subido->move($ruta, $nombre_doc);
                }
                $impugnacionResuelve = ImpugnacionResuelve::create($impugnacionResuelveNueva);

                $resuelves_ = explode(",", $request->resuelves);
                foreach ($resuelves_ as $resuelve) {
                    $impugnacionResuelve->resuelves()->attach($resuelve);
                }

                if ($request->accionantes != '') {
                    $accionantes = explode(",", $request->accionantes);
                    foreach ($accionantes as $accionante) {
                        $impugnacionResuelve->accionantes()->attach($accionante);
                    }
                }

                if ($request->accionados != '') {
                    $accionados = explode(",", $request->accionados);
                    foreach ($accionados as $accionado) {
                        $impugnacionResuelve->accionantes()->attach($accionado);
                    }
                }
            }
            $impugnacionRespuesta = Impugnacion::findOrFail($impugnacion->id)->with('resuelves')->with('resuelves.estado')->with('resuelves.resuelves')->with('resuelves.empleado')->with('resuelves.accionantes')->get();
            $impugnacionResuelveRespuesta = ImpugnacionResuelve::findOrFail($impugnacionResuelve->id)->with('impugnacion')->with('estado')->with('resuelves')->with('empleado')->with('accionantes')->get();
            return response()->json(['mensaje' => 'ok', 'data' => $impugnacionRespuesta]);
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
