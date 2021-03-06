<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEstadosTable
 * @see \App\Estado
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations of the Model Estado.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('alias');
        });
    }

    /**
     * Reverse the migrations of the Model Estado.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('estados');
    }
}
