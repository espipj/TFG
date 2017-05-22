<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('genes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('TGLA227');
            $table->integer('BM2113');
            $table->integer('TGLA53');
            $table->integer('ETH10');
            $table->integer('SPS115');
            $table->integer('TGLA126');
            $table->integer('TGLA122');
            $table->integer('INRA23');
            $table->integer('BM1818');
            $table->integer('ETH3');
            $table->integer('ETH225');
            $table->integer('BM1824');
            $table->integer('ganado_id');
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
        //
        Schema::drop('genes');
    }
}
