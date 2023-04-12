<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            // Menus padre
            //1
            ['nombre' =>  'Inicio', 'menu_id' => '0', 'url' =>  'admin/index', 'orden' => '1', 'icono' =>  'fas fa-home'],
            //------------------------------------------------------------------------------------------------------------
            //2
            ['nombre' =>  'Sistema', 'menu_id' => '0', 'url' =>  '#', 'orden' => '2', 'icono' =>  'fas fa-tools'],
            ['nombre' =>  'Menús', 'menu_id' => '2', 'url' =>  'admin/menu-index', 'orden' => '1', 'icono' =>  'fas fa-list-ul'],
            ['nombre' =>  'Roles Usuarios', 'menu_id' => '2', 'url' =>  'admin/rol-index', 'orden' => '2', 'icono' =>  'fas fa-user-tag'],
            ['nombre' =>  'Menú - Roles', 'menu_id' => '2', 'url' =>  'admin/_menus_rol', 'orden' => '3', 'icono' =>  'fas fa-chalkboard-teacher'],
            ['nombre' =>  'Permisos', 'menu_id' => '2', 'url' =>  'admin/permiso-index', 'orden' => '4', 'icono' =>  'fas fa-lock'],
            ['nombre' =>  'Permisos -Rol', 'menu_id' => '2', 'url' =>  'admin/_permiso-rol', 'orden' => '5', 'icono' =>  'fas fa-user-lock'],
            ['nombre' =>  'Usuarios', 'menu_id' => '2', 'url' =>  'admin/usuarios', 'orden' => '6', 'icono' =>  'fas fa-user-friends'],
            //------------------------------------------------------------------------------------------------------------
            //9
            ['nombre' =>  'Otras opciones', 'menu_id' => '0', 'url' =>  '#', 'orden' => '7', 'icono' =>  'fas fa-question-circle'],
            ['nombre' =>  'Consulte nuestas políticas de datos', 'menu_id' => '9', 'url' =>  'usuario/consulta-politicas', 'orden' => '1', 'icono' =>  'fas fa-question-circle'],
            ['nombre' =>  'Ayuda', 'menu_id' => '9', 'url' =>  'usuario/ayuda', 'orden' => '2', 'icono' =>  'fas fa-question-circle'],
            ['nombre' =>  'Actualizar datos', 'menu_id' => '9', 'url' =>  'usuario/actualizar-datos', 'orden' => '3', 'icono' =>  'fas fa-edit'],
            ['nombre' =>  'Cambiar contraseña', 'menu_id' => '9', 'url' =>  'usuario/cambiar-password', 'orden' => '4', 'icono' =>  'fas fa-key'],
            //------------------------------------------------------------------------------------------------------------
            //14
            ['nombre' =>  'Parametros', 'menu_id' => '0', 'url' =>  '#', 'orden' => '3', 'icono' =>  'fas fa-cogs'],
            ['nombre' =>  'Categorias Componente', 'menu_id' => '14', 'url' =>  'componentes', 'orden' => '1', 'icono' =>  'fas fa-sitemap'],
            ['nombre' =>  'Componentes', 'menu_id' => '14', 'url' =>  'subcomponentes', 'orden' => '2', 'icono' =>  'fas fa-sort-alpha-down'],
            //----------------------------------------------------------------------------------------------------------------------
            //17
            ['nombre' =>  'Propuestas', 'menu_id' => '0', 'url' =>  '#', 'orden' => '4', 'icono' =>  'fas fa-folder-open'],
            //----------------------------------------------------------------------------------------------------------------------
            //18
            ['nombre' =>  'Jurados', 'menu_id' => '0', 'url' =>  'jurados', 'orden' => '5', 'icono' =>  'fas fa-graduation-cap'],
            //----------------------------------------------------------------------------------------------------------------------
            //19
            ['nombre' =>  'Emprendedores', 'menu_id' => '0', 'url' =>  'emprendedores', 'orden' => '6', 'icono' =>  'fas fa-user-graduate'],
            //----------------------------------------------------------------------------------------------------------------------

        ];

        foreach ($menus as $menu) {
            DB::table('menu')->insert([
                'nombre' => utf8_encode(utf8_decode($menu['nombre'])),
                'menu_id' => $menu['menu_id'],
                'url' => $menu['url'],
                'orden' => $menu['orden'],
                'icono' => $menu['icono'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
