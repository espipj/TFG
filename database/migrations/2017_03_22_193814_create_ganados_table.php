<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGanadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ganados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('crotal');
            $table->string('sexo');
            $table->date('fecha_nacimiento');
            $table->timestamps();
            $table->integer('ganaderia_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ganados');
    }
}
