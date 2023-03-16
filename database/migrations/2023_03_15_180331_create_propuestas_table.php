<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuestas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('categorias_id');
            $table->foreign('categorias_id', 'fk_propuesta_categorias')->references('id')->on('categorias')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('personas_id')->unique();
            $table->foreign('personas_id','fk_propuesta_personas')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('titulo',255);
            $table->longText('descripcion')->nullable();
            $table->float('promedio', 2, 2)->nullable();
            $table->integer('estado')->nullable();
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
        Schema::dropIfExists('propuestas');
    }
}
