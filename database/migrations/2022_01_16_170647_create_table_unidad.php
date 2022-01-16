<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUnidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Unidad', function (Blueprint $table) {
            $table->increments('IdUnidad');
            $table->string('NombreUnidad');
            $table->unsignedInteger('IdUsuario')->unsigned();
            $table->foreign('IdUsuario')->references('IdUsuario')->on('Usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Unidad');
    }
}
