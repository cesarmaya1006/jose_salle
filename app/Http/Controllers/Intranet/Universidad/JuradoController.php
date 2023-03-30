<?php

namespace App\Http\Controllers\Intranet\Universidad;

use App\Http\Controllers\Controller;
use App\Models\Personas\Persona;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        //
    }

}
