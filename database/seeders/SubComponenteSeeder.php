<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubComponenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_componentes = [
            ['componente_id' => '1', 'sub_componente' => 'Estrategia general de la Propuesta de Negocio'],
            ['componente_id' => '1', 'sub_componente' => 'Misión, visión y valores Corporativos'],
            ['componente_id' => '1', 'sub_componente' => 'Estructura Administrativa'],
            ['componente_id' => '1', 'sub_componente' => 'Línea de productos o producto – Objetivos'],
            ['componente_id' => '1', 'sub_componente' => 'Mecanismos de control dentro de la Propuesta de Negocio'],
            ['componente_id' => '2', 'sub_componente' => 'Mezcla de marketing'],
            ['componente_id' => '2', 'sub_componente' => 'Investigación de mercados'],
            ['componente_id' => '2', 'sub_componente' => 'Mercado objetivo'],
            ['componente_id' => '2', 'sub_componente' => 'Imagen corporativa'],
            ['componente_id' => '2', 'sub_componente' => 'Mínimo Producto Viable - MVP'],
            ['componente_id' => '2', 'sub_componente' => 'Comunicación tradicional y estrategias de marketing digital'],
            ['componente_id' => '3', 'sub_componente' => 'Insumos por unidad producida'],
            ['componente_id' => '3', 'sub_componente' => 'Costos Indirectos de Fabricación'],
            ['componente_id' => '3', 'sub_componente' => 'Activos Fijos'],
            ['componente_id' => '3', 'sub_componente' => 'Establecimiento del precio de venta'],
            ['componente_id' => '3', 'sub_componente' => 'Estado de Resultados'],
            ['componente_id' => '3', 'sub_componente' => 'Balance'],
            ['componente_id' => '3', 'sub_componente' => 'Flujo Neto del Proyecto'],
            ['componente_id' => '4', 'sub_componente' => 'Especificaciones de los productos/servicios'],
            ['componente_id' => '4', 'sub_componente' => 'Flujo del proceso del producto/servicio'],
            ['componente_id' => '4', 'sub_componente' => 'Capacidad operativa'],
            ['componente_id' => '4', 'sub_componente' => 'Cadena de suministro de alto nivel de la empresa'],
            ['componente_id' => '4', 'sub_componente' => 'Matriz de proveedores'],
            ['componente_id' => '5', 'sub_componente' => 'Factores relacionados con oferta y demanda del bien o servicio'],
            ['componente_id' => '5', 'sub_componente' => 'Variables macroeconómicas'],
            ['componente_id' => '5', 'sub_componente' => 'Problemas ambientales en el territorio'],
            ['componente_id' => '5', 'sub_componente' => 'Costos y beneficios socioambietales'],
            ['componente_id' => '5', 'sub_componente' => 'Enfoque sostenible del emprendimiento'],
            
        ];
        foreach ($sub_componentes as $key => $value) {
            DB::table('sub_componentes')->insert([
                'componente_id' => $value['componente_id'],
                'sub_componente' => $value['sub_componente'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
