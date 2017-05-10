<?php

use App\User;
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
        User::create([
            'name' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('admin'),
        ]);
        User::create([
            'name' => 'ganadero',
            'email' => 'ganadero',
            'password' => bcrypt('ganadero'),
        ]);
        User::create([
            'name' => 'asociacion',
            'email' => 'asociacion',
            'password' => bcrypt('asociacion'),
        ]);
        User::create([
            'name' => 'laboratorio',
            'email' => 'laboratorio',
            'password' => bcrypt('laboratorio'),
        ]);
    }
}
