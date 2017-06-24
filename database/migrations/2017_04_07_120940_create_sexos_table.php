<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSexosTable
 * @see \App\Sexo
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateSexosTable extends Migration
{
    /**
     * Run the migrations of the Model Sexo.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sexos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('alias');
        });
    }

    /**
     * Reverse the migrations of the Model Sexo.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sexos');
    }
}
