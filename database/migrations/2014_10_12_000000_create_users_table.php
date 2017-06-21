<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable
 * @see \App\User
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations of the Model User.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('ganaderia_id');
            $table->integer('asociacion_id');
            $table->integer('laboratorio_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations of the Model User.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
