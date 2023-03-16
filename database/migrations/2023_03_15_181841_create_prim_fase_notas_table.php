<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimFaseNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prim_fase_notas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('prim_fase_componentes_id');
            $table->foreign('prim_fase_componentes_id', 'fk_componente_prim_fase_componentes')->references('id')->on('prim_fase_componentes')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('personas_id');
            $table->foreign('personas_id', 'fk_jurado_personas')->references('id')->on('personas')->onDelete('restrict')->onUpdate('restrict');
            $table->float('calificacion', 2, 2)->default(0);
            $table->longText('observacion');
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prim_fase_notas');
    }
}
