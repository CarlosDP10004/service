<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRolPermiso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RolPermiso', function (Blueprint $table) {
            $table->increments('IdRolPermiso');
            $table->unsignedInteger('IdRol');
            $table->foreign('IdRol')->references('IdRol')->on('Rol');
            $table->unsignedInteger('IdPermiso');
            $table->foreign('IdPermiso')->references('IdPermiso')->on('Permiso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RolPermiso');
    }
}
