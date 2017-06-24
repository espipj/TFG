<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserRoleTable
 * Migration used to generate the pivot table to relate User with Role.
 *
 *
 * @see \App\User
 * @see \App\Role
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class CreateUserRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up()
    {
        //
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->integer('role_id');
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
        Schema::drop('role_user');
    }
}
