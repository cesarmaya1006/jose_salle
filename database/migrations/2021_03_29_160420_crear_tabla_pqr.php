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
            $table->unsignedBigInteger('persona_id')->nullable();
            $table->foreign('persona_id', 'fk_persona_pqr')->references('id')->on('personas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id', 'fk_empresa_pqr')->references('id')->on('empresas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('empleado_id', 'fk_empleado_pqr')->references('id')->on('empleados')->onDelete('restrict')->onUpdate('restrict');
            $table->text('tipo', 100);
            $table->unsignedBigInteger('servicio_id')->nullable();
            $table->foreign('servicio_id', 'fk_servicio_pqr')->references('id')->on('servicios')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('referencia_id')->nullable();
            $table->foreign('referencia_id', 'fk_referencia_pqr')->references('id')->on('referencias')->onDelete('restrict')->onUpdate('restrict');
            $table->text('factura', 100);
            $table->text('adquisicion', 100)->nullable();
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->foreign('municipio_id', 'fk_municipios_pqr')->references('id')->on('municipio')->onDelete('restrict')->onUpdate('restrict');
            $table->boolean('prorroga')->default(0);
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