<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_MenuRol extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            ['rol_id' => '1', 'menu_id' => '1'],
            ['rol_id' => '1', 'menu_id' => '2'],
            ['rol_id' => '1', 'menu_id' => '3'],
            ['rol_id' => '1', 'menu_id' => '4'],
            ['rol_id' => '1', 'menu_id' => '5'],
            ['rol_id' => '1', 'menu_id' => '6'],
            ['rol_id' => '1', 'menu_id' => '7'],
            ['rol_id' => '1', 'menu_id' => '8'],
            ['rol_id' => '1', 'menu_id' => '9'],
            ['rol_id' => '1', 'menu_id' => '10'],
            ['rol_id' => '1', 'menu_id' => '11'],
            ['rol_id' => '1', 'menu_id' => '12'],
            ['rol_id' => '1', 'menu_id' => '13'],
            ['rol_id' => '1', 'menu_id' => '14'],
            ['rol_id' => '1', 'menu_id' => '15'],
            ['rol_id' => '1', 'menu_id' => '16'],
            ['rol_id' => '1', 'menu_id' => '17'],
            ['rol_id' => '2', 'menu_id' => '1'],
            ['rol_id' => '2', 'menu_id' => '2'],
            ['rol_id' => '2', 'menu_id' => '8'],
            ['rol_id' => '2', 'menu_id' => '9'],
            ['rol_id' => '2', 'menu_id' => '10'],
            ['rol_id' => '2', 'menu_id' => '11'],
            ['rol_id' => '2', 'menu_id' => '12'],
            ['rol_id' => '2', 'menu_id' => '13'],
            ['rol_id' => '2', 'menu_id' => '14'],
            ['rol_id' => '2', 'menu_id' => '15'],
            ['rol_id' => '2', 'menu_id' => '16'],
            ['rol_id' => '2', 'menu_id' => '17'],

        ];

        foreach ($tipos as $tipo) {
            DB::table('menu_rol')->insert([
                'rol_id' => $tipo['rol_id'],
                'menu_id' => $tipo['menu_id'],
            ]);
        }

        /*for ($i = 1; $i <= 18; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => '1',
                'menu_id' => $i,
            ]);
        }
        for ($i = 1; $i <= 19; $i++) {
            DB::table('menu_rol')->insert([
                'rol_id' => '2',
                'menu_id' => $i,
            ]);
        }*/
    }
}
