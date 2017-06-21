<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTipoConsultasTable
 * @see \App\TipoConsulta
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateTipoConsultasTable extends Migration
{
    /**
     * Run the migrations of the Model TipoConsulta.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
        });
    }

    /**
     * Reverse the migrations of the Model TipoConsulta.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipo_consultas');
    }
}
