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
        return view('intranet.propuestas.emprendedor.registrar.index',compact('componentes'));
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
    public function propuestas_guardar(ValidacionPropuesta $request)
    {
        //======================================================
        //Propuesta
        $propuesta_new['personas_id'] = $request['personas_id'];
        $propuesta_new['titulo'] = $request['titulo'];
        $propuesta_new['codigo'] = $request['codigo'];
        $propuesta_new['descripcion'] = $request['descripcion'];
        $propuesta_new['estado'] = 1;
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('canvas')) {
            $ruta = Config::get('constantes.folder_doc_proyectos');
            $ruta = trim($ruta);
            $canvas = $request->canvas;
            $nombre_doc = time() . '-' . utf8_encode(utf8_decode($canvas->getClientOriginalName()));
            $propuesta_new['canvas'] = $nombre_doc;
            $canvas->move($ruta, $nombre_doc);
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('video')) {
            $ruta = Config::get('constantes.folder_doc_proyectos');
            $ruta = trim($ruta);
            $video = $request->video;
            $nombre_doc = time() . '-' . utf8_encode(utf8_decode($video->getClientOriginalName()));
            $propuesta_new['video'] = $nombre_doc;
            $video->move($ruta, $nombre_doc);
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $propuesta = Propuesta::create($propuesta_new);
        //=========================================================
        //componentes Primera fase
        $sub_componentes = SubComponente::get();
        $cont =0;
        foreach ($sub_componentes as $sub_componente) {
            $componenteNew['propuestas_id'] = $propuesta->id;
            $componenteNew['sub_componente_id'] = $sub_componente->id;
            $componenteNew['sustentacion'] = $request['sustentacion'][$cont];
            $componenteNew['estado'] = 1;
            $componentePrimeraFase = PrimFaseComponente::create($componenteNew);
            $cont++;
        }
        //=========================================================
        //pfds
        $i=1;
        $ruta = Config::get('constantes.folder_doc_proyectos');
        $ruta = trim($ruta);
        foreach ($propuesta->componentesFaseUno as $componente) {
            if (isset($request['pdf'][$i])) {
                for ($k=1; $k < (count($request['pdf'][$i]))+1 ; $k++) {
                    $pdf = $request['pdf'][$i][$k];
                    $nombre_doc = utf8_encode(utf8_decode($pdf->getClientOriginalName()));
                    $nombre_arch = time() . '-' . utf8_encode(utf8_decode($pdf->getClientOriginalName()));
                    $documento_new['prim_fase_componente_id'] = $componente->id;
                    $documento_new['titulo'] = $nombre_doc;
                    $documento_new['archivo'] = $nombre_arch;
                    $pdf->move($ruta, $nombre_doc);
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
            if (isset($request['imagen'][$i])) {
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
        return view('intranet.propuestas.admin.propuestas.ver',compact('propuesta','componentes'));
    }
}
