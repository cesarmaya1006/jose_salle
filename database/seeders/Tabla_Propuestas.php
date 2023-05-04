<?php

namespace Database\Seeders;

use App\Models\Universidad\Componente;
use App\Models\Universidad\SubComponente;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Propuestas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $propuestas = [
            ['personas_id' => '7', 'titulo' => 'MI PELUDO AMIGO PET SHOP','codigo'=>'CONV-FEMF-2022-001'],
            ['personas_id' => '8', 'titulo' => 'DELTIQ','codigo'=>'CONV-FEMF-2022-002'],
            ['personas_id' => '9', 'titulo' => 'TEXTIFAFST S.A.S.','codigo'=>'CONV-FEMF-2022-003'],
            ['personas_id' => '10', 'titulo' => 'FAGOSEYLI','codigo'=>'CONV-FEMF-2022-006'],
            ['personas_id' => '11', 'titulo' => 'HILOS & ARTESANÍAS BAITER','codigo'=>'CONV-FEMF-2022-009'],
            ['personas_id' => '12', 'titulo' => 'ALMAS EN MOVIMIENTO','codigo'=>'CONV-FEMF-2022-012'],
            ['personas_id' => '13', 'titulo' => 'PANU LAB','codigo'=>'CONV-FEMF-2022-014'],
            ['personas_id' => '14', 'titulo' => 'MUNDO CREATIVO A.R','codigo'=>'CONV-FEMF-2022-015'],
            ['personas_id' => '15', 'titulo' => 'CROCHETTEANDO','codigo'=>'CONV-FEMF-2022-018'],
            ['personas_id' => '16', 'titulo' => 'ERIKA UMAÑA EVENTOS','codigo'=>'CONV-FEMF-2022-019'],
            ['personas_id' => '17', 'titulo' => 'THE PUPPY SHOWER','codigo'=>'CONV-FEMF-2022-025'],
            ['personas_id' => '18', 'titulo' => 'LAVAMUEBLES&MAS','codigo'=>'CONV-FEMF-2022-029'],
            ['personas_id' => '19', 'titulo' => 'WALÚ','codigo'=>'CONV-FEMF-2022-030'],
            ['personas_id' => '20', 'titulo' => 'ALMA VERDE BY MENDOZA','codigo'=>'CONV-FEMF-2022-031'],
            ['personas_id' => '21', 'titulo' => 'COMIDAS E.P.A EMPANADAPASTELAREPA','codigo'=>'CONV-FEMF-2022-032'],
            ['personas_id' => '22', 'titulo' => 'HANNA BY JOHANNA','codigo'=>'CONV-FEMF-2022-034'],
            ['personas_id' => '23', 'titulo' => 'YALKÓN','codigo'=>'CONV-FEMF-2022-035'],
            ['personas_id' => '24', 'titulo' => 'ADORARTE VELAS Y DETALLES','codigo'=>'CONV-FEMF-2022-036'],
            ['personas_id' => '25', 'titulo' => 'SALÓN DE ONCES SAMAR','codigo'=>'CONV-FEMF-2022-039'],
            ['personas_id' => '26', 'titulo' => 'DOSAR','codigo'=>'CONV-FEMF-2022-040'],
            ['personas_id' => '27', 'titulo' => 'EL PRIMATE RACING BIKES','codigo'=>'CONV-FEMF-2022-041'],
            ['personas_id' => '28', 'titulo' => 'TOLITAMALES','codigo'=>'CONV-FEMF-2022-042'],
            ['personas_id' => '29', 'titulo' => 'CUEROS DE COLOMBIA A.G.2','codigo'=>'CONV-FEMF-2022-043'],
            ['personas_id' => '30', 'titulo' => 'CLICK','codigo'=>'CONV-FEMF-2022-046'],
            ['personas_id' => '31', 'titulo' => 'NATURAL_TFA','codigo'=>'CONV-FEMF-2022-047'],
            ['personas_id' => '32', 'titulo' => 'DELI FRESA FUNZA','codigo'=>'CONV-FEMF-2022-048'],
            ['personas_id' => '33', 'titulo' => 'ERILO','codigo'=>'CONV-FEMF-2022-052'],
            ['personas_id' => '34', 'titulo' => 'SOLTECHNO','codigo'=>'CONV-FEMF-2022-053'],
            ['personas_id' => '35', 'titulo' => 'EL TALLER DE COSTURA','codigo'=>'CONV-FEMF-2022-054'],
            ['personas_id' => '36', 'titulo' => 'COLOMBIANA DE SOLUCIONES TECNOLOGICAS','codigo'=>'CONV-FEMF-2022-056'],
            ['personas_id' => '37', 'titulo' => 'MALE PASTRY PLACE PASTELERA Y REPOSTERIA PERSONALIZADA','codigo'=>'CONV-FEMF-2022-004'],
            ['personas_id' => '38', 'titulo' => 'SAN JORGE','codigo'=>'CONV-FEMF-2022-100'],
            ['personas_id' => '39', 'titulo' => 'CONTRATISTA ALCALDIA FUNZA','codigo'=>'EQ-SDE-FEMF-2022-03'],
            ['personas_id' => '40', 'titulo' => 'MOSTAZA','codigo'=>'CONV-FEMF-2022-060'],
            ['personas_id' => '41', 'titulo' => 'ARTE Y SABIDURIA DJ','codigo'=>'CONV-FEMF-2022-065'],
            ['personas_id' => '42', 'titulo' => 'BIOINSUMOS EL LEUSE','codigo'=>'CONV-FEMF-2022-066'],
            ['personas_id' => '43', 'titulo' => 'EL ARCA, VIDA Y SALUD','codigo'=>'CONV-FEMF-2022-067'],
            ['personas_id' => '44', 'titulo' => 'LH ESTETICA Y BELLEZA','codigo'=>'CONV-FEMF-2022-068'],
            ['personas_id' => '45', 'titulo' => 'LA PERFU COLOMBIA','codigo'=>'CONV-FEMF-2022-069'],
            ['personas_id' => '46', 'titulo' => 'LALA Y SUS AMIGOS','codigo'=>'CONV-FEMF-2022-071'],
            ['personas_id' => '47', 'titulo' => 'ALIMENTOS VICTORY FOODS','codigo'=>'CONV-FEMF-2022-072'],
            ['personas_id' => '48', 'titulo' => 'BEMVELO','codigo'=>'CONV-FEMF-2022-074'],
            ['personas_id' => '49', 'titulo' => 'CERVECERÍA ARTESANAL AVIADOR','codigo'=>'CONV-FEMF-2022-081'],
            ['personas_id' => '50', 'titulo' => 'SACHAPP.CO','codigo'=>'CONV-FEMF-2022-085'],
            ['personas_id' => '51', 'titulo' => 'DECORACIONES BAM BAM','codigo'=>'CONV-FEMF-2022-086'],
            ['personas_id' => '52', 'titulo' => 'PRAGMA SAZÓN','codigo'=>'CONV-FEMF-2022-088'],
            ['personas_id' => '53', 'titulo' => 'ZAQUECERVECERIA','codigo'=>'CONV-FEMF-2022-089'],
            ['personas_id' => '54', 'titulo' => 'PAPELERÍA CREATIVA Y BISUTERÍA ARTESANAL','codigo'=>'CONV-FEMF-2022-091'],
            ['personas_id' => '55', 'titulo' => 'MANUFACTURAS LA&LA','codigo'=>'CONV-FEMF-2022-094'],
            ['personas_id' => '56', 'titulo' => 'GANADERIA FREDY','codigo'=>'CONV-FEMF-2022-097'],
            ['personas_id' => '57', 'titulo' => 'EXPLOTACIÓN GANADERA ROSO','codigo'=>'CONV-FEMF-2022-099'],
            ['personas_id' => '58', 'titulo' => 'COMPUREDES','codigo'=>'CONV-FEMF-2022-103'],
            ['personas_id' => '59', 'titulo' => 'CAMELO´S','codigo'=>'CONV-FEMF-2022-104'],
            ['personas_id' => '60', 'titulo' => "BAR S'VALENTINA",'codigo'=>'CONV-FEMF-2022-105'],
            ['personas_id' => '61', 'titulo' => 'MARA CREACIONES','codigo'=>'CONV-FEMF-2022-109'],
            ['personas_id' => '62', 'titulo' => 'ARREGLOS Y CONFECCIONES JIREH','codigo'=>'CONV-FEMF-2022-116'],
            ['personas_id' => '63', 'titulo' => 'SWEET ALIMENTOS ARTESANALES','codigo'=>'CONV-FEMF-2022-111'],
            ['personas_id' => '64', 'titulo' => "DANISA MODA'S",'codigo'=>'CONV-FEMF-2022-113'],
            ['personas_id' => '65', 'titulo' => 'THE SWEET STATION','codigo'=>'CONV-FEMF-2022-114'],
            ['personas_id' => '66', 'titulo' => 'SOLO ASEO FUNZA','codigo'=>'CONV-FEMF-2022-118'],
            ['personas_id' => '67', 'titulo' => 'EL PORVENIR','codigo'=>'CONV-FEMF-2022-119'],
            ['personas_id' => '68', 'titulo' => 'CONTRATISTA ALCALDIA FUNZA','codigo'=>'EQ-SDE-FEMF-2022-01'],
            ['personas_id' => '69', 'titulo' => 'CONTRATISTA ALCALDIA FUNZA','codigo'=>'EQ-SDE-FEMF-2022-02'],

        ];
        foreach ($propuestas as $item) {
            DB::table('propuestas')->insert([
                'personas_id' => $item['personas_id'],
                'titulo' => $item['titulo'],
                'codigo' => $item['codigo'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $subComponentes = SubComponente::get();
            foreach ($subComponentes as $subComponente) {
                DB::table('prim_fase_componentes')->insert([
                    'propuestas_id' => ($item['personas_id']-6),
                    'sub_componente_id' => $subComponente->id,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
            $componentes = Componente::get();
            foreach ($componentes as $componente) {
                DB::table('seg_fase_componentes')->insert([
                    'propuestas_id' => ($item['personas_id']-6),
                    'componente' => $componente->componente,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
