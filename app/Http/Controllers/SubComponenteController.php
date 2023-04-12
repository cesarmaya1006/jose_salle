<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Universidad\Componente;
use App\Models\Universidad\SubComponente;
use Illuminate\Http\Request;

class SubComponenteController extends Controller
{
    public function index()
    {   $sub_componentes = SubComponente::get();
        return view('intranet.propuestas.componentes.index', compact('sub_componentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        $componentes = Componente::get();
        return view('intranet.propuestas.componentes.crear',compact('componentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        SubComponente::create($request->all());
        return redirect('subcomponentes')->with('mensaje', 'Componente creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $componentes = Componente::get();
        $sub_componente = SubComponente::findOrFail($id);
        return view('intranet.propuestas.componentes.editar', compact('sub_componente','componentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)
    {
        SubComponente::findOrFail($id)->update($request->all());
        return redirect('subcomponentes')->with('mensaje', 'Componente actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar(Request $request, $id)
    {
        if ($request->ajax()) {
            if (SubComponente::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
