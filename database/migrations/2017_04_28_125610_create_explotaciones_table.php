<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExplotacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('explotaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_explotacion');
            $table->string('municipio');
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
        Schema::drop('explotaciones');
    }
}
