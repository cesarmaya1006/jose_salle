<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Intranet\Admin\RolController;
use App\Http\Controllers\Intranet\Admin\MenuController;
use App\Http\Controllers\Extranet\ExtranetPageController;
use App\Http\Controllers\Intranet\Admin\MenuRolController;
use App\Http\Controllers\Intranet\Admin\PermisoController;
use App\Http\Controllers\Intranet\Admin\UsuarioController;
use App\Http\Controllers\Intranet\Empresas\AreaController;
use App\Http\Controllers\Intranet\Admin\PermisoRolController;
use App\Http\Controllers\Intranet\Admin\IntranetPageCotroller;
use App\Http\Controllers\Intranet\Carnet\CarnetController as CarnetCarnetController;
use App\Http\Controllers\Intranet\Empresas\CargoController;
use App\Http\Controllers\Universidad\CarreraController;
use App\Http\Controllers\Universidad\DependenciaController;
use App\Http\Controllers\Universidad\FacultadController;
use App\Http\Controllers\Universidad\InventarioController;
use App\Http\Controllers\Universidad\InvEntradaController;
use App\Http\Controllers\Universidad\InvSalidaController;
use App\Http\Controllers\Universidad\PrestamoController;
use App\Models\Admin\Usuario;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
});
Route::get('/migrar-bd', function () {
    echo Artisan::call('migrate:refresh');
});
//---------------------------------------------------------------------------------
Route::get('/', [ExtranetPageController::class, 'index'])->name('index');
Route::get('/index', [ExtranetPageController::class, 'index'])->name('index_2');
Route::get('/solicitar_password', [ExtranetPageController::class,'solicitar_password',])->name('solicitar_password');
Route::post('/cambiar_password', [ExtranetPageController::class,'cambiar_password',])->name('cambiar_password');
Route::get('/preguntas_frecuentes', [ExtranetPageController::class,'preguntas_frecuentes',])->name('preguntas_frecuentes');
Route::get('/index3', [ExtranetPageController::class, 'index_3'])->name('index_3');
Route::get('/registro_ini', [ExtranetPageController::class,'registro_ini',])->name('registro_ini');
Route::post('/registro_ini-guardar', [ExtranetPageController::class,'registro_ini_guardar',])->name('registro_ini-guardar');
Route::get('/registro_ext/{id}/{cc}/{tipo}', [ExtranetPageController::class,'registro_ext',])->name('registro_ext');
Route::get('/registro_conf', [ExtranetPageController::class,'registro_conf',])->name('registro_conf');
Route::get('/parametros', [ExtranetPageController::class, 'parametros'])->name('parametros');
Route::post('/parametros-guardar', [ExtranetPageController::class,'parametros_guardar',])->name('parametros-guardar');
Route::post('/cargar_tipo_documentos', [ExtranetPageController::class,'cargar_tipo_documentos',])->name('cargar_tipo_documentos');
//---------------------------------------------------------------------------------
Route::group(['middleware' => 'auth'], function () {
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //Rutas carfar ajax
    Route::get('cargar_areas', [AreaController::class, 'cargar_areas'])->name('cargar_areas');
    Route::get('cargar_facultades', [FacultadController::class, 'cargar_facultades'])->name('cargar_facultades');
    Route::get('cargar_cargos', [CargoController::class, 'cargar_cargos'])->name('cargar_cargos');
    Route::get('cargar_carreras', [CarreraController::class, 'cargar_carreras'])->name('cargar_carreras');
    Route::get('cargar_usuarios_carreras', [UsuarioController::class, 'cargar_usuarios_carreras'])->name('cargar_usuarios_carreras');
    Route::get('cargar_usuarios_cargos', [UsuarioController::class, 'cargar_usuarios_cargos'])->name('cargar_usuarios_cargos');
    Route::get('cargar_max_prod', [InvSalidaController::class, 'cargar_max_prod'])->name('cargar_max_prod');
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    Route::group(['prefix' => 'admin'], function () {
        Route::get('index', [IntranetPageCotroller::class, 'index'])->name('admin-index');
        Route::post('restablecer-password', [IntranetPageCotroller::class,'restablecer_password',])->name('admin-restablecer_password');
        // Rutas Index
        // ------------------------------------------------------------------------------------
        Route::group(['middleware' => 'adminSistema'], function () {
            // Ruta Administrador del Sistema Menus
            // ------------------------------------------------------------------------------------
            Route::get('menu-index', [MenuController::class, 'index'])->name('admin-menu-index');
            Route::get('menu-crear', [MenuController::class, 'crear'])->name('admin-menu-crear');
            Route::get('menu/{id}/editar', [MenuController::class,'editar',])->name('admin-menu-editar');
            Route::post('menu', [MenuController::class, 'guardar'])->name('admin-menu-guardar');
            Route::put('menu/{id}', [MenuController::class,'actualizar',])->name('admin-menu-actualizar');
            Route::get('menu/{id}/eliminar', [MenuController::class,'eliminar',])->name('admin-menu-eliminar');
            Route::get('menu-guardar-orden', [MenuController::class,'guardarOrden',])->name('admin-menu-guardar-orden');
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Roles
            Route::get('rol-index', [RolController::class, 'index'])->name('admin-rol-index');
            Route::get('rol-crear', [RolController::class, 'crear'])->name('admin-rol-crear');
            Route::get('rol/{id}/editar', [RolController::class,'editar',])->name('admin-rol-editar');
            Route::post('rol', [RolController::class, 'guardar'])->name('admin-rol-guardar');
            Route::put('rol/{id}', [RolController::class, 'actualizar'])->name('admin-rol-actualizar');
            Route::delete('rol/{id}/eliminar', [RolController::class,'eliminar',])->name('admin-rol-eliminar');
            Route::get('roles/export/', [RolController::class,'exportarExcel',])->name('roles-exportarExcel');
            // ------------------------------------------------------------------------------------
            /*RUTAS Administrador del Sistema MENU_ROL*/
            Route::get('_menus_rol', [MenuRolController::class, 'index'])->name('admin-menu_rol');
            Route::post('_menus_rol', [MenuRolController::class,'guardar',])->name('admin-guardar_menu_rol');
            // ------------------------------------------------------------------------------------
            /*RUTAS DE PERMISO*/
            Route::get('permiso-index', [PermisoController::class,'index',])->name('admin-permiso-index');
            Route::get('permiso-crear/{pagVolver?}', [PermisoController::class,'crear',])->name('admin-crear_permiso');
            Route::post('permiso', [PermisoController::class, 'guardar'])->name('admin-guardar_permiso');
            Route::get('permiso/{id}/editar', [PermisoController::class,'editar',])->name('admin-editar_permiso');
            Route::put('permiso/{id}', [PermisoController::class,'actualizar',])->name('admin-actualizar_permiso');
            Route::delete('permiso/{id}', [PermisoController::class,'eliminar',])->name('admin-eliminar_permiso');
            // ------------------------------------------------------------------------------------
            /*RUTAS PERMISO_ROL*/
            Route::get('_permiso-rol', [PermisoRolController::class,'index',])->name('admin-permiso_rol');
            Route::post('_permiso-rol', [PermisoRolController::class,'guardar',])->name('admin-guardar_permiso_rol');

            // ------------------------------------------------------------------------------------
        });
        // ------------------------------------------------------------------------------------
        Route::group(['middleware' => 'administrador'], function () {
            // Ruta Administrador del Sistema Usuarios
            Route::get('usuario-index', [UsuarioController::class,'index',])->name('admin-usuario-index');
            Route::get('usuario-crear', [UsuarioController::class,'crear',])->name('admin-usuario-crear');
            Route::post('usuario', [UsuarioController::class, 'guardar'])->name('admin-usuario-guardar');
            Route::get('usuario/{id}/editar', [UsuarioController::class,'editar',])->name('admin-usuario-editar');
            Route::put('usuario/{id}', [UsuarioController::class,'actualizar',])->name('admin-usuario-actualizar');
            Route::delete('usuario/{id}', [UsuarioController::class,'eliminar',])->name('admin-usuario-eliminar');
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Areas
            Route::get('areas', [AreaController::class,'index',])->name('admin-areas');
            Route::get('areas-crear', [AreaController::class,'crear',])->name('admin-areas-crear');
            Route::post('areas', [AreaController::class, 'guardar'])->name('admin-areas-guardar');
            Route::get('areas/{id}/editar', [AreaController::class,'editar',])->name('admin-areas-editar');
            Route::put('areas/{id}', [AreaController::class,'actualizar',])->name('admin-areas-actualizar');
            Route::delete('areas/{id}', [AreaController::class,'eliminar',])->name('admin-areas-eliminar');
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Cargos
            Route::get('cargos', [CargoController::class,'index',])->name('admin-cargos');
            Route::get('cargos-crear', [CargoController::class,'crear',])->name('admin-cargos-crear');
            Route::post('cargos', [CargoController::class, 'guardar'])->name('admin-cargos-guardar');
            Route::get('cargos/{id}/editar', [CargoController::class,'editar',])->name('admin-cargos-editar');
            Route::put('cargos/{id}', [CargoController::class,'actualizar',])->name('admin-cargos-actualizar');
            Route::delete('cargos/{id}', [CargoController::class,'eliminar',])->name('admin-cargos-eliminar');
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Facultades
            Route::get('facultades', [FacultadController::class,'index',])->name('admin-facultades');
            Route::get('facultades-crear', [FacultadController::class,'crear',])->name('admin-facultades-crear');
            Route::post('facultades', [FacultadController::class, 'guardar'])->name('admin-facultades-guardar');
            Route::get('facultades/{id}/editar', [FacultadController::class,'editar',])->name('admin-facultades-editar');
            Route::put('facultades/{id}', [FacultadController::class,'actualizar',])->name('admin-facultades-actualizar');
            Route::delete('facultades/{id}', [FacultadController::class,'eliminar',])->name('admin-facultades-eliminar');
            // ------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Carreras
            Route::get('carreras', [CarreraController::class,'index',])->name('admin-carreras');
            Route::get('carreras-crear', [CarreraController::class,'crear',])->name('admin-carreras-crear');
            Route::post('carreras', [CarreraController::class, 'guardar'])->name('admin-carreras-guardar');
            Route::get('carreras/{id}/editar', [CarreraController::class,'editar',])->name('admin-carreras-editar');
            Route::put('carreras/{id}', [CarreraController::class,'actualizar',])->name('admin-carreras-actualizar');
            Route::delete('carreras/{id}', [CarreraController::class,'eliminar',])->name('admin-carreras-eliminar');
            // ------------------------------------------------------------------------------------
        });
        // ------------------------------------------------------------------------------------
        Route::group(['middleware' => 'administrador'], function () {
            Route::group(['prefix' => 'parametros'], function () {
                // Rutas carnets
                Route::get('carnets-index', [CarnetCarnetController::class, 'index'])->name('admin-parametros-canets-index');
                Route::get('carnets-configurar/{id}', [CarnetCarnetController::class, 'configurar'])->name('admin-parametros-canets-configurar');
                Route::put('carnets-configurar-actualizar/{id}', [CarnetCarnetController::class,'actualizar',])->name('admin-parametros-canets-configurar-actualizar');
                // ------------------------------------------------------------------------------------
            });
                // Rutas usuarios
                Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios-index');
                Route::get('usuarios/importar', [UsuarioController::class, 'importar'])->name('usuarios-importar');
                Route::post('usuarios/import',[UsuarioController::class,'import'])->name('usuarios-import');
                Route::get('usuarios/cargar/{id}',[UsuarioController::class,'cargar'])->name('usuarios-cargar');
        });
        //Rutas inventarios
        Route::get('inventarios', [InventarioController::class, 'index'])->name('inventarios');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::group(['prefix' => 'inventarios','middleware' => ['administrador']], function () {
            // ------------------------------------------------------------------------------------
            // Ruta Dependencias
            Route::get('dependencias', [DependenciaController::class,'index',])->name('dependencias');
            Route::get('dependencias-crear', [DependenciaController::class,'crear',])->name('dependencias-crear');
            Route::post('dependencias', [DependenciaController::class, 'guardar'])->name('dependencias-guardar');
            Route::get('dependencias/{id}/editar', [DependenciaController::class,'editar',])->name('dependencias-editar');
            Route::put('dependencias/{id}', [DependenciaController::class,'actualizar',])->name('dependencias-actualizar');
            Route::delete('dependencias/{id}', [DependenciaController::class,'eliminar',])->name('dependencias-eliminar');

        });
        Route::group(['prefix' => 'inventarios'], function () {
            // ------------------------------------------------------------------------------------
            // Ruta Inventarios expecificos
            Route::get('inventarios-crear/{id}', [InventarioController::class,'crear',])->name('inventarios-crear');
            Route::post('inventarios', [InventarioController::class, 'guardar'])->name('inventarios-guardar');
            Route::get('inventarios/{id}/editar', [InventarioController::class,'editar',])->name('inventarios-editar');
            Route::put('inventarios/{id}', [InventarioController::class,'actualizar',])->name('inventarios-actualizar');
            Route::delete('inventarios/{id}', [InventarioController::class,'eliminar',])->name('inventarios-eliminar');
            // ------------------------------------------------------------------------------------
            Route::get('entradas/{id}', [InvEntradaController::class,'crear',])->name('entradas-crear');
            Route::post('entradas', [InvEntradaController::class, 'guardar'])->name('entradas-guardar');
            // ------------------------------------------------------------------------------------
            Route::get('salidas/{id}', [InvSalidaController::class,'crear',])->name('salidas-crear');
            Route::post('salidas', [InvSalidaController::class, 'guardar'])->name('salidas-guardar');
            // ------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------
            Route::get('elementos-crear/{id}', [InventarioController::class,'producto_crear',])->name('elementos-crear');
            Route::post('elementos', [InventarioController::class, 'producto_guardar'])->name('elementos-guardar');
            Route::get('elementos/{id}/editar', [InventarioController::class,'producto_editar',])->name('elementos-editar');
            Route::put('elementos/{id}', [InventarioController::class,'producto_actualizar',])->name('elementos-actualizar');
            Route::delete('elementos/{id}', [InventarioController::class,'producto_eliminar',])->name('elementos-eliminar');
            // ------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------
            Route::get('prestamos/{id}', [PrestamoController::class,'index',])->name('prestamos');
            Route::get('prestamos-crear/{id}', [PrestamoController::class,'crear',])->name('prestamos-crear');
            Route::post('prestamos', [PrestamoController::class, 'guardar'])->name('prestamos-guardar');
            Route::get('prestamos/{id}/devolucion', [PrestamoController::class,'editar',])->name('prestamos-devolucion');
            Route::put('prestamos/{id}', [PrestamoController::class,'actualizar',])->name('prestamos-actualizar');
            Route::delete('prestamos/{id}', [PrestamoController::class,'eliminar',])->name('prestamos-eliminar');
            // ------------------------------------------------------------------------------------

        });
    });
});
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
