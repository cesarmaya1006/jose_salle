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
            $componente_primera_fase = PrimFaseComponente::findOrFail($id);
            $propuesta = Propuesta::findOrfail($componente_primera_fase->propuestas_id);
            //=====================================================================================
            $nuevaNota['prim_fase_componentes_id'] = $id;
            $nuevaNota['personas_id'] = session('id_usuario');
            $nuevaNota['calificacion'] = $request['calificacion'];
            if ($request['observacion']!=null) {
                $nuevaNota['observacion'] = $request['observacion'];
            }
            $nota =PrimFaseNota::create($nuevaNota);
            $observacion = $nota->observacion;
            $nota = $nota->calificacion;
            //=====================================================================================
            $sumNotasPrimFaseComp = $componente_primera_fase->notas->sum('calificacion');
            $cantJurados = $propuesta->jurados->count();
            $promedioComponente['not_promedio'] = $sumNotasPrimFaseComp/$cantJurados;
            PrimFaseComponente::findOrFail($id)->update($promedioComponente);
            //=====================================================================================
            $componentes = Componente::get();
            $sumComponente=[];
            $i=0;
            foreach ($componentes as $componente) {
                $i++;
                foreach ($componente_primera_fase->propuesta->componentesFaseUno as $compoPrimera) {
                   if ($componente->id == $compoPrimera->subcomponente->componente_id) {
                    $sumComponente[$i][] = $compoPrimera->not_promedio;
                   }
                }
            }
            $notaFinal=0;
            foreach ($sumComponente as $compo) {
                $notaFinal += array_sum($compo)/count($compo);
            }
            $finalPromedio = $notaFinal/$componentes->count();
            $propuestaUpdate['promedio_primera'] = $finalPromedio;

            Propuesta::findOrFail($propuesta->id)->update($propuestaUpdate);
            $resp = 'Propuesta calificada con exito';
            return response()->json(['mensaje' => 'ok','propuesta' => $propuesta,'id'=>$id,'resp'=>$resp,'observacion'=>$observacion,'nota'=>$nota]);
        } else {
            abort(404);
        }
    }
}
