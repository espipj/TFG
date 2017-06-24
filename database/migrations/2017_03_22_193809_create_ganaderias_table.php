<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateGanaderiasTable
 * @see \App\Ganaderia
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateGanaderiasTable extends Migration
{
    /**
     * Run the migrations of the Model Ganaderia.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganaderias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('sigla');
            $table->string('email');
            $table->string('telefono');
            $table->integer('asociacion_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations of the Model Ganaderia.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ganaderias');
    }
}
