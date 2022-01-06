<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Usuario', function (Blueprint $table) {
            $table->increments('IdUsuario');
            $table->string('NombreUsuario')->unique();
            $table->string('Contrasenna');
            $table->boolean('Estado');
            $table->integer('Intento');                        
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Usuario');
    }
}
