<?php

namespace App\Http\Controllers\Intranet\Universidad;

use App\Http\Controllers\Controller;
use App\Models\Personas\Persona;
use App\Models\Universidad\Componente;
use App\Models\Universidad\PrimFaseComponente;
use App\Models\Universidad\PrimFaseNota;
use App\Models\Universidad\Propuesta;
use Illuminate\Http\Request;

class JuradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurados = Persona::with('propuestas_j')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 3);
        })->get();
        //dd($jurados->toArray());
        return view('intranet.propuestas.admin.jurados.index',compact('jurados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function asignacion()
    {
        $jurados = Persona::with('propuestas_j')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 3);
        })->get();
        $propuestas = Propuesta::get();
        //dd($jurados->toArray());
        return view('intranet.propuestas.admin.jurados.asignacion',compact('jurados','propuestas'));
    }
    public function calificar_primera_fase($id){
        $propuesta = Propuesta::findOrFail($id);
        $componentes = Componente::get();
        return view('intranet.propuestas.jurados.calif_prim_fase',compact('propuesta','componentes'));
    }
    public function calificar_primera_fase_guardar(Request $request,$id){
        if ($request->ajax()) {
            $componentes = Componente::get();

        $cantSubComponentes = 0;
        $nuevaNota['prim_fase_componentes_id'] = $id;
        $nuevaNota['personas_id'] = session('id_usuario');
        $nuevaNota['calificacion'] = $request['calificacion'];
        if ($request['observacion']!=null) {
            $nuevaNota['observacion'] = $request['observacion'];
        }
        PrimFaseNota::create($nuevaNota);
        $primfasecomponente = PrimFaseComponente::findOrfail($id);
        $propuesta = $primfasecomponente->componente->propuesta;
        $sumNotasPrimFaseComp = $primfasecomponente->notas->sum('calificacion');
        $cantNotasPrimFaseComp = $primfasecomponente->notas->count();
        $sub_componeneteUpdate['not_promedio'] = $sumNotasPrimFaseComp/$cantNotasPrimFaseComp;
        $cantJurados = $primfasecomponente->componente->propuesta->jurados->count();
        if ($cantJurados == $cantNotasPrimFaseComp) {
            $sub_componeneteUpdate['estado'] = 3;
        } else {
            $sub_componeneteUpdate['estado'] = 2;
        }
        PrimFaseComponente::FindOrFail($primfasecomponente->id)->update($sub_componeneteUpdate);
        $notasProyecto=0;
        foreach ($componentes as $componente) {
            $notaComponenete =0;
            foreach ($propuesta->componentesFaseUno as $sub_componenete_f1) {
                if ($sub_componenete_f1->subcomponente->componente_id == $componente->id) {
                    $notaComponenete+=$sub_componenete_f1->not_promedio;
                }
            }
            $cantSubComponentes++;
            $notasProyecto+=$notaComponenete/$componente->sub_componentes->count();
        }
        $notasProyecto = $notasProyecto/$componentes->count();
        $proyectoUpdate['promedio_primera'] = $notasProyecto;
        $cantNotas = 0;
        foreach ($propuesta->componentesFaseUno as $componentesFaseUno_f1) {
            $cantNotas += $componentesFaseUno_f1->notas->count();;
        }
        if ($cantNotas===$cantJurados) {
            $estadoPropuesta = 3;
        } else {
            $estadoPropuesta = 2;
        }
        $proyectoUpdate['estado'] = $estadoPropuesta;
        $propuesta=Propuesta::findOrfail($propuesta->id)->update($proyectoUpdate);
        $notasCalificadas = PrimFaseNota::where('personas_id',session('id_usuario'))->whereHas('componente.propuesta', function ($q) use($propuesta) {
            $q->where('id', $propuesta->id);
        })->get();
        if ($notasCalificadas === $cantSubComponentes) {
            $resp = 'Propuesta calificada con exito';
        } else {
            $resp ='Propuesta calificada parcialmente con exito';
        }
        return response()->json(['mensaje' => 'ok','propuesta' => $propuesta,'id'=>$id,'resp'=>$resp]);
        } else {
            abort(404);
        }
    }
}
