<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRolesTable
 * @see \App\Role
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateRolesTable extends Migration
{
    /**
     * Run the migrations of the Model Role.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations of the Model Role.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }
}
