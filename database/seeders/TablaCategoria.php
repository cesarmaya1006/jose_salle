<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaCategoria extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $componentes = [
            'Administrativo',
            'Mercadeo',
            'Financiero',
            'Producción, logística y operaciones',
            'Sostenibilidad',
        ];

        foreach ($componentes as $key => $value) {
            DB::table('categorias')->insert([
                'categoria' => $value,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
