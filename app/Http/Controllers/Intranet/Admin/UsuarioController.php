<?php

namespace App\Http\Controllers\Intranet\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ImportUsuario;
use App\Models\Admin\Area;
use App\Models\Admin\Facultad;
use App\Models\Admin\Rol;
use App\Models\Admin\Tipo_Docu;
use App\Models\Admin\Usuario;
use App\Models\Mgl\Apoderado;
use App\Models\Mgl\Asistente;
use App\Models\Personas\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Facades\Excel;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::where('id', '>', '2')->get();
        return view('intranet.sistema.usuario.index', compact('roles'));
    }

    public function importar()
    {
        return view('intranet.sistema.usuario.importar');
    }

    public function import(Request $request){
        $file = $request->file('file');
        //$excel = Excel::load($file->getRealPath())->get();
        //$excel = Excel::import($request->file('file')->store('files'));
        //dd($excel);
        Excel::import(new ImportUsuario, $request->file('file')->store('files'));
        return redirect('admin/usuarios')->with(
            'mensaje',
            'Importacion hecha con éxito'
        );
    }

    public function cargar(Request $request,$id){
        if ($request->ajax()) {
            $id = $_GET['id'];
            $persona = Persona::with('tipos_docu')
                              ->with('usuario')
                              ->with('usuario.roles')
                              ->with('usuario.roles.carnets')
                              ->with('cargo')
                              ->with('cargo.area')
                              ->with('carrera')
                              ->with('carrera.facultad')
                              ->findOrFail($id);
            return $persona;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        $tiposdocu = Tipo_Docu::orderBy('id')->get();
        $roles = Rol::where('id', '>', '2')
            ->orderBy('id')
            ->pluck('nombre', 'id')
            ->toArray();
        $areas = Area::get();
        $facultades = Facultad::get();
        return view(
            'intranet.sistema.usuario.crear',
            compact('roles', 'tiposdocu','areas','facultades')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        //.........................................................................
        $nuevoUsuario['docutipos_id'] = $request['docutipos_id'];
        $nuevoUsuario['identificacion'] = $request['identificacion'];
        $nuevoUsuario['nombres'] = utf8_encode(ucwords($request['nombres']));
        $nuevoUsuario['apellidos'] = utf8_encode(
            ucwords($request['apellidos'])
        );
        $nuevoUsuario['email'] = strtolower($request['email']);
        $nuevoUsuario['telefono'] = $request['telefono'];
        $nuevoUsuario['password'] = bcrypt(utf8_encode($request['password']));
        $nuevoUsuario['camb_password'] = 0;
        $roles = $request->rol_id;
        $roles['estado'] = 1;
        $usuario = Usuario::create($nuevoUsuario);
        $usuario->roles()->sync($request->rol_id);
        //...........................................................................
        return redirect('admin/usuario-index')->with(
            'mensaje',
            'Usuario creado con exito'
        );
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
        $tiposdocu = Tipo_Docu::orderBy('id')->get();
        $roles = Rol::where('id', '>', 1)
            ->orderBy('id')
            ->pluck('nombre', 'id')
            ->toArray();
        $data = Usuario::findOrFail($id);
        return view(
            'intranet.sistema.usuario.editar',
            compact('data', 'roles', 'tiposdocu')
        );
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
        $actualizar_usuario['docutipos_id'] = $request['docutipos_id'];
        $actualizar_usuario['identificacion'] = $request['identificacion'];
        $actualizar_usuario['nombres'] = $request['nombres'];
        $actualizar_usuario['apellidos'] = $request['apellidos'];
        $actualizar_usuario['email'] = $request['email'];
        $actualizar_usuario['telefono'] = $request['telefono'];
        $roles = $request->rol_id;
        $roles['estado'] = 1;
        $usuario = Usuario::findOrFail($id);
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Usuario::findOrFail($id)->update($actualizar_usuario);
        $usuario->update($actualizar_usuario);
        //-------------------------------------------
        return redirect('admin/usuario-index')->with(
            'mensaje',
            'Usuario Actualizado con exito'
        );
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
