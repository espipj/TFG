<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCapasTable
 * @see \App\Capa
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateCapasTable extends Migration
{
    /**
     * Run the migrations of the Model Capa.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('alias');
        });
    }

    /**
     * Reverse the migrations of the Model Capa.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('capas');
    }
}
