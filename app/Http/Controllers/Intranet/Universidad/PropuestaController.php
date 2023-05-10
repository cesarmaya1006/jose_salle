<?php

namespace App\Http\Controllers\Intranet\Universidad;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionPropuesta;
use App\Models\Empresa\PropuestaJurado;
use App\Models\Personas\Persona;
use App\Models\Universidad\Categoria;
use App\Models\Universidad\Componente;
use App\Models\Universidad\Documento;
use App\Models\Universidad\Foto;
use App\Models\Universidad\PrimFaseComponente;
use App\Models\Universidad\Propuesta;
use App\Models\Universidad\SegFaseComponente;
use App\Models\Universidad\SubComponente;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image as InterventionImage;

class PropuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propuestas = Propuesta::get();
        foreach ($propuestas as $propuesta) {
            switch ($propuesta->estado) {
                case 1:
                    $propuesta['estado_str'] = 'Sin registro completo';
                    break;
                case 2:
                    $propuesta['estado_str'] = 'Registrada sin calificaciones';
                    break;

                case 3:
                    $propuesta['estado_str'] = 'Con calificación 1era fase incompleta';
                    break;

                case 4:
                    $propuesta['estado_str'] = 'Con calificación 1era fase completa';
                    break;

                case 5:
                    $propuesta['estado_str'] = 'Con calificación 2da fase incompleta';
                    break;
                default:
                    $propuesta['estado_str'] = 'Con calificación 2da fase completa';
                break;
            }
        }
        $jurados = Persona::with('usuario')->with('usuario.roles')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 3);
        })->get();
        $emprendedores = Persona::with('usuario')->with('usuario.roles')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 4);
        })->get();

        return view('intranet.propuestas.index',compact('propuestas','jurados','emprendedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function propuestas()
    {
        if (session('rol_id') < 3) {
            $propuestas = Propuesta::get();
        } elseif(session('rol_id') == 3) {
            $propuestas = Propuesta::whereHas('jurados', function ($q) {
                $q->where('id', session('rol_id'));
            })->get();
        }else{
            $propuestas = Propuesta::where('personas_id',session('rol_id'))->get();
        }

        $propuestas = Propuesta::get();
        foreach ($propuestas as $propuesta) {
            switch ($propuesta->estado) {
                case 1:
                    $propuesta['estado_str'] = 'Sin registro completo';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    break;
                case 2:
                    $propuesta['estado_str'] = 'Registrada sin calificaciones';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    break;

                case 3:
                    $propuesta['estado_str'] = 'Con calificación 1era fase incompleta';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    break;

                case 4:
                    $propuesta['estado_str'] = 'Con calificación 1era fase completa';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    break;

                case 5:
                    $propuesta['estado_str'] = 'Con calificación 2da fase incompleta';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    break;
                default:
                    $propuesta['estado_str'] = 'Con calificación 2da fase completa';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                break;
            }

        }
        return view('intranet.propuestas.admin.propuestas.index',compact('propuestas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function propuestas_crear_2()
    {
        $jurados = Persona::with('usuario')->with('usuario.roles')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 3);
        })->get();
        $emprendedores = Persona::with('usuario')->with('usuario.roles')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 4);
        })->get();
        $categorias=Categoria::get();
        return view('intranet.propuestas.admin.propuestas.crear',compact('jurados','emprendedores','categorias'));
    }
    public function propuestas_crear()
    {
        $componentes = Componente::get();
        $usuario = Persona::findOrFail(session('id_usuario'));
        return view('intranet.propuestas.emprendedor.registrar.index',compact('componentes','usuario'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function propuestas_guardar_categorias(Request $request)
    {
        if ($request->ajax()) {
            $categoria = Categoria::create($request->all());
                $categorias = Categoria::get();
                return response()->json(['mensaje' => 'ok', 'categorias' => $categorias, 'categoria' => $categoria]);

        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function propuestas_guardar(Request $request)
    {
        //dd($request->all());
        //======================================================
        //======================================================
        //Propuesta
        $propuesta_new['descripcion'] = $request['descripcion'];
        $propuesta_new['sector'] = $request['sector'];
        $propuesta_new['annos'] = $request['annos'];
        $propuesta_new['meses'] = $request['meses'];
        $propuesta_new['estado'] = 2;
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('informe')) {
            $ruta = Config::get('constantes.folder_doc_proyectos');
            $ruta = trim($ruta);
            $informe = $request->informe;
            $nombre_doc = time() . '-' . utf8_encode(utf8_decode($informe->getClientOriginalName()));
            $propuesta_new['informe'] = $nombre_doc;
            $informe->move($ruta, $nombre_doc);
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        // - - - - - - - - - - - - - - - - - - - - - - - -
        Propuesta::findOrFail($request['propuestas_id'])->update($propuesta_new);
        unset($propuesta_new);
        $propuesta = Propuesta::findOrFail($request['propuestas_id']);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('canvas')) {
            $ruta = Config::get('constantes.folder_doc_proyectos');
            $ruta = trim($ruta);
            $canvas = $request->canvas;
            $nombre_doc = time() . '-' . utf8_encode(utf8_decode($canvas->getClientOriginalName()));
            $canvas->move($ruta, $nombre_doc);
            $componenteNew['canvas'] = $nombre_doc;
            $componenteNew['estado'] = 2;
            $primeraFase_ = PrimFaseComponente::where('propuestas_id',$request['propuestas_id'])->where('sub_componente_id',1)->get();
            foreach ($primeraFase_ as $item) {
                $primeraFase = $item;
            }
            PrimFaseComponente::findOrFail($primeraFase->id)->update($componenteNew);
            unset($componenteNew);
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        /*if ($request->hasFile('video')) {
            $ruta = Config::get('constantes.folder_doc_proyectos');
            $ruta = trim($ruta);
            $video = $request->video;
            $nombre_doc = time() . '-' . utf8_encode(utf8_decode($video->getClientOriginalName()));
            $componenteNew['video'] = $nombre_doc;
            $video->move($ruta, $nombre_doc);
            $componenteNew['estado'] = 2;
            $primeraFase_ = PrimFaseComponente::where('propuestas_id',$request['propuestas_id'])->where('sub_componente_id',2)->get();
            foreach ($primeraFase_ as $item) {
                $primeraFase = $item;
            }
            PrimFaseComponente::findOrFail($primeraFase->id)->update($componenteNew);
            unset($componenteNew);
        }*/
        //=========================================================
        //componentes Primera fase
        $sub_componentes = SubComponente::get();
        $cont =0;
        foreach ($sub_componentes as $sub_componente) {
            if ($sub_componente->id > 1) {
                if ($sub_componente->id === 2) {
                    $componenteNew['video'] = $request['video'];
                    $componenteNew['estado'] = 2;
                    $primeraFase_ = PrimFaseComponente::where('propuestas_id',$request['propuestas_id'])->where('sub_componente_id',2)->get();
                    foreach ($primeraFase_ as $item) {
                        $primeraFase = $item;
                    }
                    PrimFaseComponente::findOrFail($primeraFase->id)->update($componenteNew);
                    unset($componenteNew);
                }elseif($sub_componente->id === 31){
                    if ($request->hasFile('excel')) {
                        $ruta = Config::get('constantes.folder_doc_proyectos');
                        $ruta = trim($ruta);
                        $excel = $request->excel;
                        $nombre_doc = time() . '-' . utf8_encode(utf8_decode($excel->getClientOriginalName()));
                        $excel->move($ruta, $nombre_doc);
                        $componenteNew['excel'] = $nombre_doc;
                        $componenteNew['estado'] = 2;
                        $primeraFase_ = PrimFaseComponente::where('propuestas_id',$request['propuestas_id'])->where('sub_componente_id',31)->get();
                        foreach ($primeraFase_ as $item) {
                            $primeraFase = $item;
                        }
                        PrimFaseComponente::findOrFail($primeraFase->id)->update($componenteNew);
                        unset($componenteNew);
                    }

                } else {
                    $componenteNew['sustentacion'] = $request['sustentacion'][$cont];
                    $componenteNew['estado'] = 2;
                    $primeraFase_ = PrimFaseComponente::where('propuestas_id',$request['propuestas_id'])->where('sub_componente_id',$sub_componente->id)->get();
                    foreach ($primeraFase_ as $item) {
                        $primeraFase = $item;
                    }
                    PrimFaseComponente::findOrFail($primeraFase->id)->update($componenteNew);
                    unset($componenteNew);
                    $cont++;
                }
            }
        }
        //=========================================================
        //pfds
        $i=1;
        $ruta = Config::get('constantes.folder_doc_proyectos');
        $ruta = trim($ruta);
        foreach ($propuesta->componentesFaseUno as $componente) {
            if (isset($request['pdf'][$i])&& $componente->sub_componente_id>2) {
                for ($k=1; $k < (count($request['pdf'][$i]))+1 ; $k++) {
                    $pdf = $request['pdf'][$i][$k];
                    $nombre_doc = utf8_encode(utf8_decode($pdf->getClientOriginalName()));
                    $nombre_arch = time() . '-' . utf8_encode(utf8_decode($pdf->getClientOriginalName()));
                    $documento_new['prim_fase_componente_id'] = $componente->id;
                    $documento_new['titulo'] = $nombre_doc;
                    $documento_new['archivo'] = $nombre_arch;
                    $pdf->move($ruta, $nombre_arch);
                    Documento::create($documento_new);
                }
            }
            $i++;
        }
        //=========================================================
        //imagenes
        $i=1;
        $ruta = Config::get('constantes.folder_doc_proyectos');
        $ruta = trim($ruta);
        foreach ($propuesta->componentesFaseUno as $componente) {
            if (isset($request['imagen'][$i])&& $componente->sub_componente_id>2) {
                for ($k=1; $k < (count($request['imagen'][$i]))+1 ; $k++) {
                    $imagen_nueva = $request['imagen'][$i][$k];
                    $imagen_nueva_archivo = InterventionImage::make($imagen_nueva);
                    $imagen_nueva_bd_titu = utf8_encode(utf8_decode($imagen_nueva->getClientOriginalName()));
                    $imagen_nueva_bd = time() . '-' . utf8_encode(utf8_decode($imagen_nueva->getClientOriginalName()));
                    $imagen_nueva_archivo->resize(600, 600);
                    $imagen_nueva_archivo->save($ruta . $imagen_nueva_bd, 100);
                    $fotosNew['titulo'] = $imagen_nueva_bd_titu;
                    $fotosNew['foto'] = $imagen_nueva_bd;
                    $fotosNew['prim_fase_componente_id'] = $componente->id;
                    Foto::create($fotosNew);
                }
            }
            $i++;
        }
        //=========================================================
        return redirect('admin/index')->with('mensaje', 'Propuesta creada con exito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function propuestas_editar($id)
    {
        $jurados = Persona::with('usuario')->with('usuario.roles')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 3);
        })->get();
        $emprendedores = Persona::with('usuario')->with('usuario.roles')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 4);
        })->get();
        $categorias=Categoria::get();
        $propuesta = Propuesta::findOrFail($id);
        return view('intranet.propuestas.admin.propuestas.editar',compact('jurados','emprendedores','categorias','propuesta'));
    }
    public function propuestas_actualizar(ValidacionPropuesta $request, $id){
        //dd($request->all());
        $propuesta_new['categorias_id'] = $request['categorias_id'];
        $propuesta_new['personas_id'] = $request['personas_id'];
        $propuesta_new['titulo'] = $request['titulo'];
        $propuesta_new['descripcion'] = $request['descripcion'];
        $propuesta_new['estado'] = 1;
        $propuesta_act = Propuesta::findOrFail($id)->update($propuesta_new);
        $propuesta= Propuesta::findOrFail($id);
        PropuestaJurado::where('propuesta_id',$id)->delete();
        $propuesta->jurados()->sync($request->jurados);
        PrimFaseComponente::where('propuestas_id',$id)->delete();
        foreach ($request['componentes'] as $componente) {
            $componente_new ['propuestas_id'] = $propuesta->id;
            $componente_new ['componente'] = $componente;
            PrimFaseComponente::create($componente_new);
        }
        SegFaseComponente::where('propuestas_id',$id)->delete();
        foreach ($request['componentes_dos'] as $componente) {
            $componente_new ['propuestas_id'] = $propuesta->id;
            $componente_new ['componente'] = $componente;
            SegFaseComponente::create($componente_new);
        }
        $propuestas = Propuesta::get();
        $mensaje = 'Propuesta creada con exito';
        return redirect('propuestas-index')->with('mensaje', 'Propuesta creada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function componente_eliminar(Request $request,$id)
    {
        if ($request->ajax()) {
            if (PrimFaseComponente::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    public function componente_dos_eliminar(Request $request,$id)
    {
        if ($request->ajax()) {
            if (SegFaseComponente::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    public function propuestas_ver($id){
        $componentes = Componente::get();
        $propuesta = Propuesta::findOrFail($id);
        switch ($propuesta->estado) {
            case 1:
                $propuesta['estado_str'] = 'Registrada sin calificaciones';
                break;

            case 2:
                $propuesta['estado_str'] = 'Con calificación 1era fase incompleta';
                break;

            case 3:
                $propuesta['estado_str'] = 'Con calificación 1era fase completa';
                break;

            case 4:
                $propuesta['estado_str'] = 'Con calificación 2da fase incompleta';
                break;
            default:
                $propuesta['estado_str'] = 'Con calificación 2da fase completa';
            break;
        }
        return view('intranet.propuestas.admin.propuestas.ver',compact('propuesta','componentes'));
    }

    public function propuestas_asignar($id){
        $jurados = Persona::with('usuario')->with('usuario.roles')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 3);
        })->get();
        $propuesta = Propuesta::findOrFail($id);
        return view('intranet.propuestas.admin.propuestas.asignacion_jurados',compact('propuesta','jurados'));
    }



    public function propuestas_asignar_guardar(Request $request,$persona_id,$propuesta_id){
        if ($request->ajax()) {
            $propuestas = new Propuesta();
            if ($request->input('valor') == 1) {
                $propuestas->find($propuesta_id)->jurados()->attach($persona_id);
                return response()->json(['mensaje' => 'ok']);
            } else {
                $propuestas->find($propuesta_id)->jurados()->detach($persona_id);
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
    public function emprendedores(){
        $emprendedores = Persona::with('usuario')->with('usuario.roles')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 4);
        })->get();
        return view('intranet.propuestas.emprendedor.index', compact('emprendedores'));
    }

    public function exportar_notas($id){
        $propuesta = Propuesta::findOrFail($id);
        $componentes = Componente::get();
        $notas=[];
        foreach ($componentes as $componente) {
            $nota_componente =0;
            foreach ($propuesta->componentesFaseUno as $componenteFaseUno) {
                if ($componenteFaseUno->subcomponente->componente_id === $componente->id) {
                    $nota_componente+= $componenteFaseUno->not_promedio;
                }
            }
            $componente['promedio'] = $nota_componente/$componente->sub_componentes->count();
        }
        $data=['propuesta' => $propuesta,'componentes'=>$componentes];
        $pdf = PDF::loadView('intranet.propuestas.admin.exportar.exportar_pdf',$data);

        return $pdf->download('Reporte notas '. $propuesta->codigo .'.pdf');
    }
}
