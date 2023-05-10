<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'usuario' => 'adminsis',
            'password' => bcrypt('adminsis'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'adminsis@gmail.com',
            'email' => 'adminsis@gmail.com',
            'password' => bcrypt('adminsis'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('usuario_rol')->insert([
            'rol_id' => 1,
            'usuario_id' => 1,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'admin',
            'password' => bcrypt('admin'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'admin@gmail.com',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 2,
            'usuario_id' => 2,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        $jurados=[
            ['usuario' =>'josé.medina','password' =>'79611924', 'identificacion' => '79611924', 'nombre1' => 'José', 'nombre2' => 'Gregorio', 'apellido1' => 'Medina', 'apellido2' => 'Cepeda', 'telefono' => '3138872295','email' => 'jgmedina@unisalle.edu.co'],
            ['usuario' =>'rubén.díaz','password' =>'91455827', 'identificacion' => '91455827', 'nombre1' => 'Rubén', 'nombre2' => 'Darío', 'apellido1' => 'Díaz', 'apellido2' => 'Mateus', 'telefono' => '3003017403','email' => 'rudiaz@unisalle.edu.co'],
            ['usuario' =>'juan.bravo','password' =>'79054021', 'identificacion' => '79054021', 'nombre1' => 'Juan', 'nombre2' => 'Hernando', 'apellido1' => 'Bravo', 'apellido2' => 'Reyes', 'telefono' => '3143312813','email' => 'jbravo@unisalle.edu.co'],
            ['usuario' =>'omar.sierra','password' =>'79882924', 'identificacion' => '79882924', 'nombre1' => 'Omar', 'nombre2' => 'Andrés', 'apellido1' => 'Sierra', 'apellido2' => 'Morales', 'telefono' => '3102838947','email' => 'osierra@unisalle.edu.co'],
            ['usuario' =>'carlos.ortega','password' =>'1032383639', 'identificacion' => '1032383639', 'nombre1' => 'Carlos', 'nombre2' => 'Eduardo', 'apellido1' => 'Ortega', 'apellido2' => 'Peña', 'telefono' => '3043807945','email' => 'cortega@unisalle.edu.co'],
            ['usuario' =>'elena.infante','password' =>'52496625', 'identificacion' => '52496625', 'nombre1' => 'Elena Del Pilar', 'nombre2' => null, 'apellido1' => 'Infante', 'apellido2' => 'Sánchez', 'telefono' => '3012324449','email' => 'einfante@unisalle.edu.co'],
            ['usuario' =>'wilson.garcía','password' =>'93395675', 'identificacion' => '93395675', 'nombre1' => 'Wilson', 'nombre2' => 'Oviedo', 'apellido1' => 'García', 'apellido2' => null, 'telefono' => '3187556034','email' => 'woviedo@unisalle.edu.co'],
            ['usuario' =>'sander.rangel','password' =>'88157907', 'identificacion' => '88157907', 'nombre1' => 'Sander', 'nombre2' => 'Alberto', 'apellido1' => 'Rangel', 'apellido2' => 'Jiménez', 'telefono' => '3158057865','email' => 'sarangel@lasalle.edu.co'],
        ];
        $usuario_id = 3;
        foreach ($jurados as $key => $value) {

            DB::table('usuarios')->insert([
                'usuario' =>  $value['usuario'],
                'password' => bcrypt($value['password']),
                'camb_password' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            DB::table('users')->insert([
                'name' => $value['email'],
                'email' => $value['email'],
                'password' => bcrypt($value['password']),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            DB::table('usuario_rol')->insert([
                'rol_id' => 3,
                'usuario_id' => $usuario_id,
                'estado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            DB::table('personas')->insert([
                'id' =>  $usuario_id,
                'docutipos_id' => 1,
                'identificacion' => $value['identificacion'],
                'nombre1' => $value['nombre1'],
                'nombre2' => $value['nombre2'],
                'apellido1' => $value['apellido1'],
                'apellido2' => $value['apellido2'],
                'telefono' => $value['telefono'],
                'email' => $value['email'],
                'estado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $usuario_id++;
        }
        /*
        //---------------------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'jose.medina',
            'password' => bcrypt('79611924'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'jgmedina@gmail.com',
            'email' => 'jgmedina@gmail.com',
            'password' => bcrypt('79611924'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 3,
            'usuario_id' => 3,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('personas')->insert([
            'id' => 3,
            'docutipos_id' => 1,
            'identificacion' => '79611924',
            'nombre1' => 'Jose',
            'nombre2' => 'Gregorio',
            'apellido1' => 'Medina',
            'telefono' => '3138872295',
            'direccion' => 'Calle 1 # 1-01',
            'email' => 'jgmedina@gmail.com',
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'omar.sierra',
            'password' => bcrypt('79111222'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'omar.sierra@gmail.com',
            'email' => 'omar.sierra@gmail.com',
            'password' => bcrypt('79111222'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 3,
            'usuario_id' => 4,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('personas')->insert([
            'id' => 4,
            'docutipos_id' => 1,
            'identificacion' => '79111222',
            'nombre1' => 'Omar',
            'nombre2' => 'Sierra',
            'apellido1' => 'Medina',
            'telefono' => '310112233',
            'direccion' => 'Calle 1 # 1-01',
            'email' => 'omar.sierra@gmail.com',
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'elena.infante',
            'password' => bcrypt('79444555'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'elena.infante@gmail.com',
            'email' => 'elena.infante@gmail.com',
            'password' => bcrypt('79444555'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 3,
            'usuario_id' => 5,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('personas')->insert([
            'id' => 5,
            'docutipos_id' => 1,
            'identificacion' => '79444555',
            'nombre1' => 'Elena',
            'nombre2' => 'Infante',
            'apellido1' => 'Medina',
            'telefono' => '310112233',
            'direccion' => 'Calle 1 # 1-01',
            'email' => 'elena.infante@gmail.com',
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'cesar.maya',
            'password' => bcrypt('79984883'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'cesarmaya1006@gmail.com',
            'email' => 'cesarmaya1006@gmail.com',
            'password' => bcrypt('79984883'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 4,
            'usuario_id' => 6,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('personas')->insert([
            'id' => 6,
            'docutipos_id' => 1,
            'identificacion' => '79984883',
            'nombre1' => 'Cesar',
            'apellido1' => 'Maya',
            'telefono' => '3138872295',
            'direccion' => 'Calle 1 # 1-01',
            'email' => 'cesarmaya1006@gmail.com',
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        */
        $usuarios = [
            ['usuario' => 'natalia.garzon', 'password' => '1073516926'],
            ['usuario' => 'ronald.delgado', 'password' => '80214918'],
            ['usuario' => 'sergio.callejas', 'password' => '79486130'],
            ['usuario' => 'freddy.muñoz', 'password' => '80655165'],
            ['usuario' => 'eliana.baiter', 'password' => '45767423'],
            ['usuario' => 'alison.guaqueta', 'password' => '1007703395'],
            ['usuario' => 'karen.heredia', 'password' => '1073507447'],
            ['usuario' => 'ruth.villegas', 'password' => '1107102219'],
            ['usuario' => 'sonia.laverde', 'password' => '52852155'],
            ['usuario' => 'erika.umaña', 'password' => '35525711'],
            ['usuario' => 'claudia.romero', 'password' => '52891095'],
            ['usuario' => 'virgilio.rativa', 'password' => '19467453'],
            ['usuario' => 'diana.peña', 'password' => '1073516031'],
            ['usuario' => 'gladys.mendoza', 'password' => '39736411'],
            ['usuario' => 'mariela.bello', 'password' => '35415635'],
            ['usuario' => 'johanna.ramirez', 'password' => '1073508936'],
            ['usuario' => 'gilberto.parra', 'password' => '14961942'],
            ['usuario' => 'tania.vargas', 'password' => '28488668'],
            ['usuario' => 'dirley.laverde', 'password' => '52664146'],
            ['usuario' => 'michael.guanume', 'password' => '1073245448'],
            ['usuario' => 'carlos.castillo', 'password' => '80072004'],
            //['usuario' => 'alejandro.aguja', 'password' => '1110176947'],
            ['usuario' => 'alida.lopez', 'password' => '41790002'],
            ['usuario' => 'leidy.urbano', 'password' => '52664617'],
            ['usuario' => 'estefania.sanchez', 'password' => '1073507466'],
            ['usuario' => 'benjamin.hastamorir', 'password' => '11436758'],
            ['usuario' => 'claudia.cabra', 'password' => '1073380875'],
            ['usuario' => 'romulo.vargas', 'password' => '80148085'],
            ['usuario' => 'juan.rozo', 'password' => '1000049737'],
            ['usuario' => 'wigsthon.osorio', 'password' => '79904206'],
            ['usuario' => 'maria.sierra', 'password' => '1018451821'],
            ['usuario' => 'elisa.torres', 'password' => '35531863'],
            //['usuario' => 'juan.zamora', 'password' => '1003703923'],
            ['usuario' => 'luz.pita', 'password' => '52751529'],
            ['usuario' => 'dennys.nauza', 'password' => '52229631'],
            ['usuario' => 'omar.marquez', 'password' => '1066511136'],
            ['usuario' => 'maria.martinez', 'password' => '52057099'],
            ['usuario' => 'carmen.hernandez', 'password' => '1032461570'],
            ['usuario' => 'carolina.morato', 'password' => '1073515210'],
            ['usuario' => 'derly.bonilla', 'password' => '52806870'],
            ['usuario' => 'johanna.garcia', 'password' => '1073503489'],
            ['usuario' => 'natalia.rodriguez', 'password' => '1073515408'],
            ['usuario' => 'sebastian.mejia', 'password' => '80656884'],
            ['usuario' => 'angelica.portuguez', 'password' => '53062274'],
            //['usuario' => 'maria.torres', 'password' => '1073527702'],
            ['usuario' => 'darin.beltran', 'password' => '1073516902'],
            ['usuario' => 'marlon.angarita', 'password' => '1073505494'],
            ['usuario' => 'dora.diaz', 'password' => '40987739'],
            ['usuario' => 'julio.buitrago', 'password' => '1193555077'],
            ['usuario' => 'fredy.diaz', 'password' => '1068973254'],
            ['usuario' => 'evelio.rozo', 'password' => '80656209'],
            //['usuario' => 'luis.naranjo', 'password' => '80383236'],
            ['usuario' => 'orlando.camelo', 'password' => '79306162'],
            ['usuario' => 'yeisson.fuquen', 'password' => '1136888847'],
            ['usuario' => 'esneda.lopez', 'password' => '52661403'],
            ['usuario' => 'luz.rodriguez', 'password' => '39623691'],
            ['usuario' => 'claudia.salas', 'password' => '52910368'],
            ['usuario' => 'flor.torres', 'password' => '1148959570'],
            ['usuario' => 'paula.reyes', 'password' => '1073511576'],
            ['usuario' => 'cristian.vargas', 'password' => '1010246763'],
            ['usuario' => 'jose.quintero', 'password' => '3100540'],
            ['usuario' => 'diana.valbuena', 'password' => '1073155295'],
            ['usuario' => 'sandra.cruz', 'password' => '52870165'],
        ];
        foreach ($usuarios as $key => $value) {
            DB::table('usuarios')->insert([
                'usuario' => $value['usuario'],
                'password' => bcrypt($value['password']),
                'camb_password' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        $users=[
            ['name' => 'mipeludoamigopetshop@gmail.com', 'email' => 'mipeludoamigopetshop@gmail.com','password'=>'1073516926'],
            ['name' => 'rmdg1984@gmail.com', 'email' => 'rmdg1984@gmail.com','password'=>'80214918'],
            ['name' => 'gerenciatextifast@gmail.com', 'email' => 'gerenciatextifast@gmail.com','password'=>'79486130'],
            ['name' => 'fagoseyli@gmail.com', 'email' => 'fagoseyli@gmail.com','password'=>'80655165'],
            ['name' => 'elipa-28@hotmail.com', 'email' => 'elipa-28@hotmail.com','password'=>'45767423'],
            ['name' => 'adgznana@gmail.com', 'email' => 'adgznana@gmail.com','password'=>'1007703395'],
            ['name' => 'herediasalejandra@gmail.com', 'email' => 'herediasalejandra@gmail.com','password'=>'1073507447'],
            ['name' => 'elmundocreativoa.r@gmail.com', 'email' => 'elmundocreativoa.r@gmail.com','password'=>'1107102219'],
            ['name' => 'crochetteando.bogota@gmail.com', 'email' => 'crochetteando.bogota@gmail.com','password'=>'52852155'],
            ['name' => 'erikauma2014@gmail.com', 'email' => 'erikauma2014@gmail.com','password'=>'35525711'],
            ['name' => 'romeroclaudia10@hotmail.com', 'email' => 'romeroclaudia10@hotmail.com','password'=>'52891095'],
            ['name' => 'brillocolor.v@gmail.com', 'email' => 'brillocolor.v@gmail.com','password'=>'19467453'],
            ['name' => 'dianalorenpn@gmail.com', 'email' => 'dianalorenpn@gmail.com','password'=>'1073516031'],
            ['name' => 'mendozaprieto@hotmail.com', 'email' => 'mendozaprieto@hotmail.com','password'=>'39736411'],
            ['name' => 'mariela.bello13@gmail.com', 'email' => 'mariela.bello13@gmail.com','password'=>'35415635'],
            ['name' => 'johannisjar1@gmail.com', 'email' => 'johannisjar1@gmail.com','password'=>'1073508936'],
            ['name' => 'gilberto.gilpar@gmail.com', 'email' => 'gilberto.gilpar@gmail.com','password'=>'14961942'],
            ['name' => 'tvvnfj@hotmail.com', 'email' => 'tvvnfj@hotmail.com','password'=>'28488668'],
            ['name' => 'dirleylaverde@gmail.com', 'email' => 'dirleylaverde@gmail.com','password'=>'52664146'],
            ['name' => 'dgfinanciero@gmail.com', 'email' => 'dgfinanciero@gmail.com','password'=>'1073245448'],
            ['name' => 'castell007@gmail.com', 'email' => 'castell007@gmail.com','password'=>'80072004'],
            ['name' => 'alidalperez@gmail.com', 'email' => 'alidalperez@gmail.com','password'=>'41790002'],
            ['name' => 'gerencia.urbanotex@gmail.com', 'email' => 'gerencia.urbanotex@gmail.com','password'=>'52664617'],
            ['name' => 'tefa8980@hotmail.com', 'email' => 'tefa8980@hotmail.com','password'=>'1073507466'],
            ['name' => 'benpafres7028@gmail.com', 'email' => 'benpafres7028@gmail.com','password'=>'11436758'],
            ['name' => 'erilogroup@gmail.com', 'email' => 'erilogroup@gmail.com','password'=>'1073380875'],
            ['name' => 'alexvars2@gmail.com', 'email' => 'alexvars2@gmail.com','password'=>'80148085'],
            ['name' => 'rozoj1124@gmail.com', 'email' => 'rozoj1124@gmail.com','password'=>'1000049737'],
            ['name' => 'colsolutech@gmail.com', 'email' => 'colsolutech@gmail.com','password'=>'79904206'],
            ['name' => 'malejasb10@hotmail.com', 'email' => 'malejasb10@hotmail.com','password'=>'1018451821'],
            ['name' => 'elisaparedes459@gmail.com', 'email' => 'elisaparedes459@gmail.com','password'=>'35531863'],
            //['name' => 'juancotube36@gmail.com', 'email' => 'juancotube36@gmail.com','password'=>'1003703923'],
            ['name' => 'lupita.cyc@gmail.com', 'email' => 'lupita.cyc@gmail.com','password'=>'52751529'],
            ['name' => 'lorenanauza@hotmail.com', 'email' => 'lorenanauza@hotmail.com','password'=>'52229631'],
            ['name' => 'bioinsumoselleuse@gmail.com', 'email' => 'bioinsumoselleuse@gmail.com','password'=>'1066511136'],
            ['name' => 'elarcavidaysalud@gmail.com', 'email' => 'elarcavidaysalud@gmail.com','password'=>'52057099'],
            ['name' => 'carmenwilches94@gmail.com', 'email' => 'carmenwilches94@gmail.com','password'=>'1032461570'],
            ['name' => 'c.moratto2@gmail.com', 'email' => 'c.moratto2@gmail.com','password'=>'1073515210'],
            ['name' => 'derlyjbana18@gmail.com', 'email' => 'derlyjbana18@gmail.com','password'=>'52806870'],
            ['name' => 'joha.garcia0326@gmail.com', 'email' => 'joha.garcia0326@gmail.com','password'=>'1073503489'],
            ['name' => 'bemvelo.natural@gmail.com', 'email' => 'bemvelo.natural@gmail.com','password'=>'1073515408'],
            ['name' => 'donsebastian40@gmail.com', 'email' => 'donsebastian40@gmail.com','password'=>'80656884'],
            ['name' => 'ayportuguez@gmail.com', 'email' => 'ayportuguez@gmail.com','password'=>'53062274'],
            //['name' => 'mariat-emperatriz@hotmail.com', 'email' => 'mariat-emperatriz@hotmail.com','password'=>'1073527702'],
            ['name' => 'darineliana@gmail.com', 'email' => 'darineliana@gmail.com','password'=>'1073516902'],
            ['name' => 'zaquecerveceria@gmail.com', 'email' => 'zaquecerveceria@gmail.com','password'=>'1073505494'],
            ['name' => 'dolidisu@gmail.com', 'email' => 'dolidisu@gmail.com','password'=>'40987739'],
            ['name' => 'alexitosking15@gmail.com', 'email' => 'alexitosking15@gmail.com','password'=>'1193555077'],
            ['name' => '08freddydiaz@gmail.com', 'email' => '08freddydiaz@gmail.com','password'=>'1068973254'],
            ['name' => 'eveliorozocanas@gmail.com', 'email' => 'eveliorozocanas@gmail.com','password'=>'80656209'],
            //['name' => 'lenaranjod@unal.edu.co', 'email' => 'lenaranjod@unal.edu.co','password'=>'80383236'],
            ['name' => 'orlandom63@homail.com', 'email' => 'orlandom63@homail.com','password'=>'79306162'],
            ['name' => 'alejandro-gato27@outlook.es', 'email' => 'alejandro-gato27@outlook.es','password'=>'1136888847'],
            ['name' => 'esneda09@hotmail.com', 'email' => 'esneda09@hotmail.com','password'=>'52661403'],
            ['name' => 'luzma.rodriguez@hotmail.es', 'email' => 'luzma.rodriguez@hotmail.es','password'=>'39623691'],
            ['name' => 'marcesalas26@gmail.com', 'email' => 'marcesalas26@gmail.com','password'=>'52910368'],
            ['name' => 'florgranados022@gmail.com', 'email' => 'florgranados022@gmail.com','password'=>'1148959570'],
            ['name' => 'chikis921106@gmail.com', 'email' => 'chikis921106@gmail.com','password'=>'1073511576'],
            ['name' => 'DASAVARGASPE@GMAIL.COM', 'email' => 'DASAVARGASPE@GMAIL.COM','password'=>'1010246763'],
            ['name' => 'jvmoncho95@gmail.com', 'email' => 'jvmoncho95@gmail.com','password'=>'3100540'],
            ['name' => 'dianita2840@hotmail.com', 'email' => 'dianita2840@hotmail.com','password'=>'1073155295'],
            ['name' => 'sandracruzge@gmail.com', 'email' => 'sandracruzge@gmail.com','password'=>'52870165'],
        ];
        foreach ($users as $key => $value) {
            DB::table('users')->insert([
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => bcrypt($value['password']),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
        $usuario_id_2 = $usuario_id;
        for ($i=7; $i < 70; $i++) {
            DB::table('usuario_rol')->insert([
                'rol_id' => 4,
                'usuario_id' =>  $usuario_id,
                'estado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $usuario_id++;
        }
        $personas = [
            ['id'=>'7','docutipos_id'=>1,'identificacion'=>'1073516926','nombre1'=>'Natalia','apellido1'=>'Garzon Betancourt','telefono'=>'3125317615','direccion'=>'mipeludoamigopetshop@gmail.com','email'=>'mipeludoamigopetshop@gmail.com',],
            ['id'=>'8','docutipos_id'=>1,'identificacion'=>'80214918','nombre1'=>'Ronald Mauricio','apellido1'=>'Delgado García','telefono'=>'3157875878','direccion'=>'rmdg1984@gmail.com','email'=>'rmdg1984@gmail.com',],
            ['id'=>'9','docutipos_id'=>1,'identificacion'=>'79486130','nombre1'=>'Sergio','apellido1'=>'Callejas Páramo','telefono'=>'3108584761','direccion'=>'gerenciatextifast@gmail.com','email'=>'gerenciatextifast@gmail.com',],
            ['id'=>'10','docutipos_id'=>1,'identificacion'=>'80655165','nombre1'=>'Freddy Alejandro','apellido1'=>'Muñoz Munar','telefono'=>'3125001953','direccion'=>'fagoseyli@gmail.com','email'=>'fagoseyli@gmail.com',],
            ['id'=>'11','docutipos_id'=>1,'identificacion'=>'45767423','nombre1'=>'Eliana Patricia','apellido1'=>'Baiter Montero','telefono'=>'3192210204','direccion'=>'elipa-28@hotmail.com','email'=>'elipa-28@hotmail.com',],
            ['id'=>'12','docutipos_id'=>1,'identificacion'=>'1007703395','nombre1'=>'Alison Dayana','apellido1'=>'Guaqueta Zuluaga','telefono'=>'3102824233','direccion'=>'adgznana@gmail.com','email'=>'adgznana@gmail.com',],
            ['id'=>'13','docutipos_id'=>1,'identificacion'=>'1073507447','nombre1'=>'Karen Alejandra','apellido1'=>'Heredia Sierra','telefono'=>'3002618961','direccion'=>'herediasalejandra@gmail.com','email'=>'herediasalejandra@gmail.com',],
            ['id'=>'14','docutipos_id'=>1,'identificacion'=>'1107102219','nombre1'=>'Ruth','apellido1'=>'Villegas Saavedra','telefono'=>'3168963599','direccion'=>'elmundocreativoa.r@gmail.com','email'=>'elmundocreativoa.r@gmail.com',],
            ['id'=>'15','docutipos_id'=>1,'identificacion'=>'52852155','nombre1'=>'Sonia Constanza','apellido1'=>'Laverde Cañón','telefono'=>'3112632878','direccion'=>'crochetteando.bogota@gmail.com','email'=>'crochetteando.bogota@gmail.com',],
            ['id'=>'16','docutipos_id'=>1,'identificacion'=>'35525711','nombre1'=>'Erika','apellido1'=>'Umaña Casallas','telefono'=>'3025162424','direccion'=>'erikauma2014@gmail.com','email'=>'erikauma2014@gmail.com',],
            ['id'=>'17','docutipos_id'=>1,'identificacion'=>'52891095','nombre1'=>'Claudia Patricia','apellido1'=>'Romero Garzon','telefono'=>'3185541563','direccion'=>'romeroclaudia10@hotmail.com','email'=>'romeroclaudia10@hotmail.com',],
            ['id'=>'18','docutipos_id'=>1,'identificacion'=>'19467453','nombre1'=>'Virgilio','apellido1'=>'Rativa Camargo','telefono'=>'3212192135','direccion'=>'brillocolor.v@gmail.com','email'=>'brillocolor.v@gmail.com',],
            ['id'=>'19','docutipos_id'=>1,'identificacion'=>'1073516031','nombre1'=>'Diana Lorena','apellido1'=>'Peña Ninco','telefono'=>'3505381028','direccion'=>'dianalorenpn@gmail.com','email'=>'dianalorenpn@gmail.com',],
            ['id'=>'20','docutipos_id'=>1,'identificacion'=>'39736411','nombre1'=>'Gladys','apellido1'=>'Mendoza Prieto','telefono'=>'3108075799','direccion'=>'mendozaprieto@hotmail.com','email'=>'mendozaprieto@hotmail.com',],
            ['id'=>'21','docutipos_id'=>1,'identificacion'=>'35415635','nombre1'=>'Mariela','apellido1'=>'Bello Barreto','telefono'=>'3167918305','direccion'=>'mariela.bello13@gmail.com','email'=>'mariela.bello13@gmail.com',],
            ['id'=>'22','docutipos_id'=>1,'identificacion'=>'1073508936','nombre1'=>'Johanna Andrea','apellido1'=>'Ramirez Vergara','telefono'=>'3102051640','direccion'=>'johannisjar1@gmail.com','email'=>'johannisjar1@gmail.com',],
            ['id'=>'23','docutipos_id'=>1,'identificacion'=>'14961942','nombre1'=>'Gilberto Antonio','apellido1'=>'Parra García','telefono'=>'3164887929','direccion'=>'gilberto.gilpar@gmail.com','email'=>'gilberto.gilpar@gmail.com',],
            ['id'=>'24','docutipos_id'=>1,'identificacion'=>'28488668','nombre1'=>'Tania','apellido1'=>'Vargas Vivas','telefono'=>'3203635646','direccion'=>'tvvnfj@hotmail.com','email'=>'tvvnfj@hotmail.com',],
            ['id'=>'25','docutipos_id'=>1,'identificacion'=>'52664146','nombre1'=>'Dirley Andrea','apellido1'=>'Laverde Amaya','telefono'=>'3203233965','direccion'=>'dirleylaverde@gmail.com','email'=>'dirleylaverde@gmail.com',],
            ['id'=>'26','docutipos_id'=>1,'identificacion'=>'1073245448','nombre1'=>'Michael David','apellido1'=>'Guanume Roberto','telefono'=>'3176987812','direccion'=>'dgfinanciero@gmail.com','email'=>'dgfinanciero@gmail.com',],
            ['id'=>'27','docutipos_id'=>1,'identificacion'=>'80072004','nombre1'=>'Carlos Enrique','apellido1'=>'Castillo Torres','telefono'=>'3103060448','direccion'=>'castell007@gmail.com','email'=>'castell007@gmail.com',],
            //['id'=>'28','docutipos_id'=>1,'identificacion'=>'1110176947asd','nombre1'=>'Alejandro','apellido1'=>'Aguja Leal','telefono'=>'3212047052','direccion'=>'alejo12xm@gmail.com','email'=>'alejo12xm@gmail.com',],
            ['id'=>'29','docutipos_id'=>1,'identificacion'=>'41790002','nombre1'=>'Alida','apellido1'=>'López Pérez','telefono'=>'3152729836','direccion'=>'alidalperez@gmail.com','email'=>'alidalperez@gmail.com',],
            ['id'=>'30','docutipos_id'=>1,'identificacion'=>'52664617','nombre1'=>'Leidy Johanna','apellido1'=>'Urbano Cifuentes','telefono'=>'3216764107','direccion'=>'gerencia.urbanotex@gmail.com','email'=>'gerencia.urbanotex@gmail.com',],
            ['id'=>'31','docutipos_id'=>1,'identificacion'=>'1073507466','nombre1'=>'Estefania','apellido1'=>'Sanchez Marin','telefono'=>'3043408582','direccion'=>'tefa8980@hotmail.com','email'=>'tefa8980@hotmail.com',],
            ['id'=>'32','docutipos_id'=>1,'identificacion'=>'11436758','nombre1'=>'Benjamin','apellido1'=>'Hastamorir Herrera','telefono'=>'3134531060','direccion'=>'benpafres7028@gmail.com','email'=>'benpafres7028@gmail.com',],
            ['id'=>'33','docutipos_id'=>1,'identificacion'=>'1073380875','nombre1'=>'Claudia Cenaida','apellido1'=>'Cabra Guerrero','telefono'=>'3114662156','direccion'=>'erilogroup@gmail.com','email'=>'erilogroup@gmail.com',],
            ['id'=>'34','docutipos_id'=>1,'identificacion'=>'80148085','nombre1'=>'Romulo Alexander','apellido1'=>'Vargas Sanabria','telefono'=>'3105209936','direccion'=>'alexvars2@gmail.com','email'=>'alexvars2@gmail.com',],
            ['id'=>'35','docutipos_id'=>1,'identificacion'=>'1000049737','nombre1'=>'Juan David','apellido1'=>'Rozo Susatama','telefono'=>'3147678007','direccion'=>'rozoj1124@gmail.com','email'=>'rozoj1124@gmail.com',],
            ['id'=>'36','docutipos_id'=>1,'identificacion'=>'79904206','nombre1'=>'Wigsthon Leonardo','apellido1'=>'Osorio Castañeda','telefono'=>'3027168611','direccion'=>'colsolutech@gmail.com','email'=>'colsolutech@gmail.com',],
            ['id'=>'37','docutipos_id'=>1,'identificacion'=>'1018451821','nombre1'=>'Maria Alejandra','apellido1'=>'Sierra Benitez','telefono'=>'3132235652','direccion'=>'malejasb10@hotmail.com','email'=>'malejasb10@hotmail.com',],
            ['id'=>'38','docutipos_id'=>1,'identificacion'=>'35531863','nombre1'=>'Elisa','apellido1'=>'Torres Paredes','telefono'=>'3013530673','direccion'=>'elisaparedes459@gmail.com','email'=>'elisaparedes459@gmail.com',],
            //['id'=>'39','docutipos_id'=>1,'identificacion'=>'1003703923','nombre1'=>'Juan Manuel','apellido1'=>'Zamora','telefono'=>'3114666991','direccion'=>'juancotube36@gmail.com','email'=>'juancotube36@gmail.com',],
            ['id'=>'40','docutipos_id'=>1,'identificacion'=>'52751529','nombre1'=>'Luz Dary','apellido1'=>'Pita Lizarazo','telefono'=>'3165265679','direccion'=>'lupita.cyc@gmail.com','email'=>'lupita.cyc@gmail.com',],
            ['id'=>'41','docutipos_id'=>1,'identificacion'=>'52229631','nombre1'=>'Dennys Lorena','apellido1'=>'Nauza Rios','telefono'=>'3138791535','direccion'=>'lorenanauza@hotmail.com','email'=>'lorenanauza@hotmail.com',],
            ['id'=>'42','docutipos_id'=>1,'identificacion'=>'1066511136','nombre1'=>'Omar Alexander','apellido1'=>'Márquez Martínez','telefono'=>'3103181438','direccion'=>'bioinsumoselleuse@gmail.com','email'=>'bioinsumoselleuse@gmail.com',],
            ['id'=>'43','docutipos_id'=>1,'identificacion'=>'52057099','nombre1'=>'Maria Consuelo','apellido1'=>'Martinez Salas','telefono'=>'3213263438','direccion'=>'elarcavidaysalud@gmail.com','email'=>'elarcavidaysalud@gmail.com',],
            ['id'=>'44','docutipos_id'=>1,'identificacion'=>'1032461570','nombre1'=>'Carmen Lorena','apellido1'=>'Hernandez Wilches','telefono'=>'3192551187','direccion'=>'carmenwilches94@gmail.com','email'=>'carmenwilches94@gmail.com',],
            ['id'=>'45','docutipos_id'=>1,'identificacion'=>'1073515210','nombre1'=>'Carolina','apellido1'=>'Morato Bolívar','telefono'=>'3134747870','direccion'=>'c.moratto2@gmail.com','email'=>'c.moratto2@gmail.com',],
            ['id'=>'46','docutipos_id'=>1,'identificacion'=>'52806870','nombre1'=>'Derly Yobana','apellido1'=>'Bonilla Zamora','telefono'=>'3228557566','direccion'=>'derlyjbana18@gmail.com','email'=>'derlyjbana18@gmail.com',],
            ['id'=>'47','docutipos_id'=>1,'identificacion'=>'1073503489','nombre1'=>'Johanna Carolina','apellido1'=>'Garcia Mora','telefono'=>'3162274101','direccion'=>'joha.garcia0326@gmail.com','email'=>'joha.garcia0326@gmail.com',],
            ['id'=>'48','docutipos_id'=>1,'identificacion'=>'1073515408','nombre1'=>'Natalia','apellido1'=>'Rodriguez Pardo','telefono'=>'3195140150','direccion'=>'bemvelo.natural@gmail.com','email'=>'bemvelo.natural@gmail.com',],
            ['id'=>'49','docutipos_id'=>1,'identificacion'=>'80656884','nombre1'=>'Sebastian Eduardo','apellido1'=>'Mejia Murillo','telefono'=>'3115104589','direccion'=>'donsebastian40@gmail.com','email'=>'donsebastian40@gmail.com',],
            ['id'=>'50','docutipos_id'=>1,'identificacion'=>'53062274','nombre1'=>'Angelica Yadira','apellido1'=>'Portuguez Niño','telefono'=>'3164144280','direccion'=>'ayportuguez@gmail.com','email'=>'ayportuguez@gmail.com',],
            //['id'=>'51','docutipos_id'=>1,'identificacion'=>'1073527702','nombre1'=>'María José','apellido1'=>'Torres Fonseca','telefono'=>'3016407817','direccion'=>'mariat-emperatriz@hotmail.com','email'=>'mariat-emperatriz@hotmail.com',],
            ['id'=>'52','docutipos_id'=>1,'identificacion'=>'1073516902','nombre1'=>'Darin Eliana','apellido1'=>'Beltrán Riaño','telefono'=>'3222186541','direccion'=>'darineliana@gmail.com','email'=>'darineliana@gmail.com',],
            ['id'=>'53','docutipos_id'=>1,'identificacion'=>'1073505494','nombre1'=>'Marlon','apellido1'=>'Angarita','telefono'=>'3005767000','direccion'=>'zaquecerveceria@gmail.com','email'=>'zaquecerveceria@gmail.com',],
            ['id'=>'54','docutipos_id'=>1,'identificacion'=>'40987739','nombre1'=>'Dora Liliana','apellido1'=>'Díaz Suavita','telefono'=>'3175245638','direccion'=>'dolidisu@gmail.com','email'=>'dolidisu@gmail.com',],
            ['id'=>'55','docutipos_id'=>1,'identificacion'=>'1193555077','nombre1'=>'Julio Alejandro','apellido1'=>'Buitrago López','telefono'=>'3204961436','direccion'=>'alexitosking15@gmail.com','email'=>'alexitosking15@gmail.com',],
            ['id'=>'56','docutipos_id'=>1,'identificacion'=>'1068973254','nombre1'=>'Fredy Adrian','apellido1'=>'Díaz Rivera','telefono'=>'3125734258','direccion'=>'08freddydiaz@gmail.com','email'=>'08freddydiaz@gmail.com',],
            ['id'=>'57','docutipos_id'=>1,'identificacion'=>'80656209','nombre1'=>'Evelio','apellido1'=>'Rozo Cañas','telefono'=>'3125206346','direccion'=>'eveliorozocanas@gmail.com','email'=>'eveliorozocanas@gmail.com',],
            //['id'=>'58','docutipos_id'=>1,'identificacion'=>'80383236','nombre1'=>'Luis Enrique','apellido1'=>'Naranjo Delgado','telefono'=>'3174393025','direccion'=>'lenaranjod@unal.edu.co','email'=>'lenaranjod@unal.edu.co',],
            ['id'=>'59','docutipos_id'=>1,'identificacion'=>'79306162','nombre1'=>'Orlando Marin','apellido1'=>'Camelo Cardenas','telefono'=>'3134001108','direccion'=>'orlandom63@homail.com','email'=>'orlandom63@homail.com',],
            ['id'=>'60','docutipos_id'=>1,'identificacion'=>'1136888847','nombre1'=>'Yeisson Alejandro','apellido1'=>'Fuquen Carrillo','telefono'=>'3204595829','direccion'=>'alejandro-gato27@outlook.es','email'=>'alejandro-gato27@outlook.es',],
            ['id'=>'61','docutipos_id'=>1,'identificacion'=>'52661403','nombre1'=>'Esneda','apellido1'=>'Lopez Ramírez','telefono'=>'3174359491','direccion'=>'esneda09@hotmail.com','email'=>'esneda09@hotmail.com',],
            ['id'=>'62','docutipos_id'=>1,'identificacion'=>'39623691','nombre1'=>'Luz Marina','apellido1'=>'Rodríguez Reyes','telefono'=>'3203141896','direccion'=>'luzma.rodriguez@hotmail.es','email'=>'luzma.rodriguez@hotmail.es',],
            ['id'=>'63','docutipos_id'=>1,'identificacion'=>'52910368','nombre1'=>'Claudia Marcela','apellido1'=>'Salas Beltrán','telefono'=>'3057927957','direccion'=>'marcesalas26@gmail.com','email'=>'marcesalas26@gmail.com',],
            ['id'=>'64','docutipos_id'=>1,'identificacion'=>'1148959570','nombre1'=>'Flor Angela','apellido1'=>'Torres Sanchez','telefono'=>'3232210498','direccion'=>'florgranados022@gmail.com','email'=>'florgranados022@gmail.com',],
            ['id'=>'65','docutipos_id'=>1,'identificacion'=>'1073511576','nombre1'=>'Paula Andrea','apellido1'=>'Reyes Méndez','telefono'=>'3204601886','direccion'=>'chikis921106@gmail.com','email'=>'chikis921106@gmail.com',],
            ['id'=>'66','docutipos_id'=>1,'identificacion'=>'1010246763','nombre1'=>'Cristian David','apellido1'=>'Vargas Espinosa','telefono'=>'3124761926','direccion'=>'DASAVARGASPE@GMAIL.COM','email'=>'DASAVARGASPE@GMAIL.COM',],
            ['id'=>'67','docutipos_id'=>1,'identificacion'=>'3100540','nombre1'=>'Jose Vicente','apellido1'=>'Quintero Prieto','telefono'=>'3196228898','direccion'=>'jvmoncho95@gmail.com','email'=>'jvmoncho95@gmail.com',],
            ['id'=>'68','docutipos_id'=>1,'identificacion'=>'1073155295','nombre1'=>'Diana Marcela','apellido1'=>'Valbuena Robayo','telefono'=>'3142734247','direccion'=>'dianita2840@hotmail.com','email'=>'dianita2840@hotmail.com',],
            ['id'=>'69','docutipos_id'=>1,'identificacion'=>'52870165','nombre1'=>'Sandra Milena','apellido1'=>'Cruz','telefono'=>'3102225765','direccion'=>'sandracruzge@gmail.com','email'=>'sandracruzge@gmail.com',],

        ];
        foreach ($personas as $key => $value) {
            DB::table('personas')->insert([
                'id' => $usuario_id_2,
                'docutipos_id' => $value['docutipos_id'],
                'identificacion' => $value['identificacion'],
                'nombre1' => $value['nombre1'],
                'apellido1' => $value['apellido1'],
                'telefono' => $value['telefono'],
                'direccion' => $value['direccion'],
                'email' => $value['email'],
                'estado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            $usuario_id_2++;
        }
    }
}
