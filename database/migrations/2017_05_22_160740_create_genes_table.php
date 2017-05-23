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
            $table->json('TGLA227');
            $table->json('BM2113');
            $table->json('TGLA53');
            $table->json('ETH10');
            $table->json('SPS115');
            $table->json('TGLA126');
            $table->json('TGLA122');
            $table->json('INRA23');
            $table->json('BM1818');
            $table->json('ETH3');
            $table->json('ETH225');
            $table->json('BM1824');
            $table->json('ganado_id');
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
