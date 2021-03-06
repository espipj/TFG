<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateGanadosTable
 *
 * @see \App\Ganado
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateGanadosTable extends Migration
{
    /**
     * Run the migrations of the Model Ganado.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('crotal')->unique();
            $table->date('fecha_nacimiento');
            $table->integer('ganaderia_id');
            $table->integer('padre_id');
            $table->integer('madre_id');
            $table->integer('sexo_id');
            $table->integer('capa_id');
            $table->integer('estado_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations of the Model Ganado.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ganados');
    }
}
