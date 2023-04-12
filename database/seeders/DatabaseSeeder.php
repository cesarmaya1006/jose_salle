<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\Tabla_TipoAccion;
use Database\Seeders\Tabla_UnidadNegocio;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTablas([
            'docutipos', 'roles', 'menu', 'menu_rol', 'icono', 'parametros', 'usuarios','componentes','sub_componentes']);
        // --------------------------------------------------------------------------------------------------
        $this->call(Tabla_DocuTipos::class);
        $this->call(Tabla_Roles::class);
        $this->call(Tabla_Menu::class);
        $this->call(Tabla_MenuRol::class);
        $this->call(Tabla_Icono::class);
        $this->call(Tabla_Parametros::class);
        $this->call(Tabla_Usuarios::class);
        $this->call(ComponenteSeeder::class);
        $this->call(SubComponenteSeeder::class);

    }

    protected function truncateTablas(array $tablas)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tablas as $tabla) {
            DB::table($tabla)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
