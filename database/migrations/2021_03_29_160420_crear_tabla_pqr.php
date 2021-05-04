<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPqr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqr', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->text('radicado', 255)->nullable();
            $table->unsignedBigInteger('persona_id')->nullable();
            $table->foreign('persona_id', 'fk_persona_pqr')->references('id')->on('personas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id', 'fk_empresa_pqr')->references('id')->on('empresas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('tipo_pqr_id')->nullable();
            $table->foreign('tipo_pqr_id', 'fk_tipoPQR_pqr')->references('id')->on('tipo_pqr')->onDelete('restrict')->onUpdate('restrict');
            $table->text('adquisicion', 100)->nullable();
            $table->unsignedBigInteger('sede_id')->nullable();
            $table->foreign('sede_id', 'fk_sede_pqr')->references('id')->on('sedes')->onDelete('restrict')->onUpdate('restrict');
            $table->text('tipo', 100);
            $table->unsignedBigInteger('servicio_id')->nullable();
            $table->foreign('servicio_id', 'fk_servicio_pqr')->references('id')->on('servicios')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('referencia_id')->nullable();
            $table->foreign('referencia_id', 'fk_referencia_pqr')->references('id')->on('referencias')->onDelete('restrict')->onUpdate('restrict');
            $table->text('factura', 100)->nullable();
            $table->date('fecha_factura', 100)->nullable();
            $table->boolean('prorroga')->default(0)->nullable();
            $table->date('fecha_generacion');
            $table->date('fecha_radicado');
            $table->date('fecha_respuesta')->nullable();
            $table->string('estado')->default('Radicada, sin iniciar tramite');
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
        Schema::dropIfExists('pqr');
    }
}
