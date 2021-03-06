<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateGenesTable
 * @see \App\Gen
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateGenesTable extends Migration
{
    /**
     * Run the migrations of the Model Gen.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('genes', function (Blueprint $table) {
            $table->increments('id');
            $table->json('nombres');
            $table->json('marcadores');
            $table->json('ganado_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations of the Model Gen.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('genes');
    }
}
