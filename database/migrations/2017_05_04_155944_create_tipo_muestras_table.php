<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTipoMuestrasTable
 * @see \App\TipoMuestra
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateTipoMuestrasTable extends Migration
{
    /**
     * Run the migrations of the Model TipoMuestra.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_muestras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
        });
    }

    /**
     * Reverse the migrations of the Model TipoMuestra.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tipo_muestras');
    }
}
