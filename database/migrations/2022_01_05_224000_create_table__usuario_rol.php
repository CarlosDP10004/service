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
            $table->integer('IdUsuario')->unsigned();
            $table->integer('IdRol')->unsigned();
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
