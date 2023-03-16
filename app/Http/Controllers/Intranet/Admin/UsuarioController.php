<?php

namespace App\Http\Controllers\Intranet\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ImportUsuario;
use App\Models\Admin\Area;
use App\Models\Admin\Facultad;
use App\Models\Admin\Rol;
use App\Models\Admin\Tipo_Docu;
use App\Models\Admin\Usuario;
use App\Models\Admin\UsuarioApi;
use App\Models\Personas\Persona;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use Intervention\Image\ImageManagerStatic as Image;

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
        return view(
            'intranet.sistema.usuario.crear',
            compact('roles', 'tiposdocu')
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
        $roles = $request->rol_id;
        //.........................................................................
        $nuevoUsuario['usuario'] = strtolower($request['nombre1'].'.'.$request['apellido1']);
        $nuevoUsuario['password'] = bcrypt(utf8_encode($request['identificacion']));
        $nuevoUsuario['camb_password'] = 0;
        $roles['estado'] = 1;
        $usuario = Usuario::create($nuevoUsuario);
        $usuario->roles()->sync($request->rol_id);
        //.........................................................................
        $newUser['id'] = $usuario->id;
        $newUser['name'] = strtolower($request['nombre1'].'.'.$request['apellido1']);
        $newUser['password'] = bcrypt(utf8_encode($request['identificacion']));
        $newUser['email'] = strtolower($request['email']);
        $usuario2 = UsuarioApi::create($newUser);
        //.........................................................................
        $nuevaPersona['id'] = $usuario->id;
        $nuevaPersona['docutipos_id'] = $request['docutipos_id'];
        $nuevaPersona['identificacion'] = $request['identificacion'];
        $nuevaPersona['nombre1'] = utf8_encode(ucwords($request['nombre1']));
        $nuevaPersona['nombre2'] = utf8_encode(ucwords($request['nombre2']));
        $nuevaPersona['apellido1'] = utf8_encode(ucwords($request['apellido1']));
        $nuevaPersona['apellido2'] = utf8_encode(ucwords($request['apellido2']));
        $nuevaPersona['telefono'] = $request['telefono'];
        $nuevaPersona['direccion'] = $request['direccion'];
        $nuevaPersona['email'] = strtolower($request['email']);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('foto')) {
            $ruta = Config::get('constantes.folder_img_usuarios');
            $ruta = trim($ruta);

            $foto = $request->foto;
            $imagen_foto = Image::make($foto);
            $nombrefoto = time() . $foto->getClientOriginalName();
            $imagen_foto->resize(400, 500);
            $imagen_foto->save($ruta . $nombrefoto, 100);
            $nuevaPersona['foto'] = $nombrefoto;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $persona = Persona::create($nuevaPersona);
        //.........................................................................
        return redirect('admin/usuarios')->with(
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
        $data = Persona::findOrFail($id);
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
        $usuario = Persona::findOrFail($id);
        $actualizar_usuario['docutipos_id'] = $request['docutipos_id'];
        $actualizar_usuario['identificacion'] = $request['identificacion'];
        $actualizar_usuario['nombre1'] = utf8_encode(ucwords($request['nombre1']));
        $actualizar_usuario['nombre2'] = utf8_encode(ucwords($request['nombre2']));
        $actualizar_usuario['apellido1'] = utf8_encode(ucwords($request['apellido1']));
        $actualizar_usuario['apellido2'] = utf8_encode(ucwords($request['apellido2']));
        $actualizar_usuario['telefono'] = $request['telefono'];
        $actualizar_usuario['direccion'] = $request['direccion'];
        $actualizar_usuario['email'] = strtolower($request['email']);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('foto')) {
            if ($usuario->foto != NULL || $usuario->foto!='usuario-inicial.jpg') {
                $ruta = Config::get('constantes.folder_img_usuarios');
                $ruta = trim($ruta);
                unlink($ruta . $usuario->foto);
            }
            $ruta = Config::get('constantes.folder_img_usuarios');
            $ruta = trim($ruta);
            $foto = $request->foto;
            $imagen_foto = Image::make($foto);
            $nombrefoto = time() . $foto->getClientOriginalName();
            $imagen_foto->resize(400, 500);
            $imagen_foto->save($ruta . $nombrefoto, 100);
            $actualizar_usuario['foto'] = $nombrefoto;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $nuevoUsuario['password'] = bcrypt(utf8_encode($request['identificacion']));
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        $newUser['password'] = bcrypt(utf8_encode($request['identificacion']));
        $newUser['email'] = strtolower($request['email']);
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        Persona::findOrFail($id)->update($actualizar_usuario);
        UsuarioApi::findOrFail($id)->update($newUser);
        Usuario::findOrFail($id)->update($nuevoUsuario);
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
    public function eliminar(Request $request, $id)
    {
        if ($request->ajax()) {
            $usuario = Usuario::findOrFail($id);
            $foto = $usuario->persona->foto;
            if (Persona::destroy($id)) {
                if ($usuario->persona->foto != NULL || $foto!='usuario-inicial.jpg') {
                    $ruta = Config::get('constantes.folder_img_usuarios');
                    $ruta = trim($ruta);
                    unlink($ruta . $foto);
                }
                DB::table('usuario_rol')->where('usuario_id', $id)->delete();
                User::destroy($id);
                Usuario::destroy($id);
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }

    public function cargar_usuarios_carreras(Request $request){
        if ($request->ajax()) {
            $id = $_GET['id'];
            $rol_id = $_GET['rol_id'];
                return Persona::with('carrera')->
            whereHas('usuario.roles', function ($p) use($rol_id) {
                $p->where('rol_id',$rol_id);
            })
            ->whereHas('carrera', function ($p) use($id) {
                $p->where('carrera_id', $id);
            })->get();
        }

    }


    public function cargar_usuarios_cargos(Request $request){
        if ($request->ajax()) {
            $id = $_GET['id'];
            return Persona::whereHas('cargo', function ($p) use($id) {
                $p->where('cargo_id', $id);
            })->get();
        }

    }

}
