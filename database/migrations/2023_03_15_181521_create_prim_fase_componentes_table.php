<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimFaseComponentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prim_fase_componentes', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('propuestas_id');
            $table->foreign('propuestas_id', 'fk_componente_uno_propuestas')->references('id')->on('propuestas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('sub_componente_id');
            $table->foreign('sub_componente_id', 'fk_componente_uno_sub_componentes')->references('id')->on('sub_componentes')->onDelete('restrict')->onUpdate('restrict');
            $table->text('sustentacion')->nullable();
            $table->float('not_promedio')->nullable();
            $table->string('canvas',255)->nullable();
            $table->string('video',255)->nullable();
            $table->string('excel',255)->nullable();
            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('prim_fase_componentes');
    }
}
