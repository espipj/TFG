<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/**
 * Class CreateGanaderosTable
 * @deprecated Changes in the needs of the client
 * @see \App\Ganadero
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateGanaderosTable extends Migration
{
    /**
     * Run the migrations of the Model Ganadero.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganaderos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido1');
            $table->string('apellido2');
            $table->string('dni');
            $table->string('email');
            $table->string('telefono');
            $table->timestamps();
            $table->integer('ganaderia_id');
        });
    }

    /**
     * Reverse the migrations of the Model Ganadero.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ganaderos');
    }
}
