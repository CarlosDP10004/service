<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClasificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Clasificacion', function (Blueprint $table) {
            $table->increments('IdClasificacion');
            $table->unsignedInteger('IdCuenta')->unsigned();
            $table->foreign('IdCuenta')->references('IdCuenta')->on('Cuenta');
            $table->string('Descripcion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Clasificacion');
    }
}
