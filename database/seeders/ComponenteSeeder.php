<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponenteSeeder extends Seeder
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
            'Propuesta de Coofinanciamiento',
        ];

        foreach ($componentes as $key => $value) {
            DB::table('componentes')->insert([
                'componente' => $value,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
