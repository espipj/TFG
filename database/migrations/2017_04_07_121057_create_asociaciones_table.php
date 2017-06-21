<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAsociacionesTable
 * @see \App\Asociacion
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateAsociacionesTable extends Migration
{
    /**
     * Run the migrations of the Model Asociacion.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asociaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->mediumText('direccion');
            $table->string('email');
            $table->string('telefono');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations of the Model Asociacion.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('asociaciones');
    }
}
