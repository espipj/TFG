<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuestrasTable extends Migration
{
    /**
     * Run the migrations.
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
            $table->integer('tipomuestra_id');
            $table->integer('tipoconsulta_id');
            $table->integer('laboratorio_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('muestras');
    }
}
