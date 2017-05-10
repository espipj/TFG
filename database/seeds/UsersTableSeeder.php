<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'name' => 'ganadero',
            'email' => 'ganadero',
            'password' => bcrypt('ganadero'),
        ]);
        DB::table('users')->insert([
            'name' => 'asociacion',
            'email' => 'asociacion',
            'password' => bcrypt('asociacion'),
        ]);
        DB::table('users')->insert([
            'name' => 'laboratorio',
            'email' => 'laboratorio',
            'password' => bcrypt('laboratorio'),
        ]);
    }
}
