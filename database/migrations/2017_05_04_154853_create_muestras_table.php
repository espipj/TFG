<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMuestrasTable
 * @see \App\Muestra
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateMuestrasTable extends Migration
{
    /**
     * Run the migrations of the Model Muestra.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muestras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tubo')->unique();
            $table->date('fecha_extraccion');
            $table->integer('ganado_id');
            $table->integer('tipo_muestra_id');
            $table->integer('tipo_consulta_id');
            $table->integer('laboratorio_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations of the Model Muestra.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('muestras');
    }
}
