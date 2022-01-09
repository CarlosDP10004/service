<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsuarioRol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UsuarioRol', function (Blueprint $table) {
            $table->increments('IdUsuarioRol');
            $table->unsignedInteger('IdUsuario')->unsigned();
            $table->foreign('IdUsuario')->references('IdUsuario')->on('Usuario');
            $table->unsignedInteger('IdRol')->unsigned();
            $table->foreign('IdRol')->references('IdRol')->on('Rol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UsuarioRol');
    }
}
