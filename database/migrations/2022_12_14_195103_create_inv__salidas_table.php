<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv__salidas', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id', 'fk_usuario_salidas')->references('id')->on('usuarios')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('inventario_id');
            $table->foreign('inventario_id', 'fk_inventario_salidas')->references('id')->on('inventarios')->onDelete('restrict')->onUpdate('restrict');
            $table->string('proveedor', 250);
            $table->date('fec_salida');
            $table->bigInteger('cantidad');
            $table->bigInteger('costo');
            $table->longText('observaciones')->nullable();
            $table->bigInteger('estado')->default('1');
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
        Schema::dropIfExists('inv__salidas');
    }
}