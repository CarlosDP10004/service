<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePlaza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Plaza', function (Blueprint $table) {
            $table->increments('IdPlaza');
            $table->string('NombrePlaza');
            $table->unsignedInteger('IdUnidad')->unsigned();
            $table->foreign('IdUnidad')->references('IdUnidad')->on('Unidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Plaza');
    }
}
