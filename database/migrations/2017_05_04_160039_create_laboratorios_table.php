<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLaboratoriosTable
 * @see \App\Laboratorio
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateLaboratoriosTable extends Migration
{
    /**
     * Run the migrations of the Model Laboratorio.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratorios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('email');
            $table->string('telefono');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations of the Model Laboratorio.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('laboratorios');
    }
}
