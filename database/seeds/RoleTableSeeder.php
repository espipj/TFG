<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_user=new Role();
        $role_user->name='Ganadero';
        $role_user->description='Un usuario normal';
        $role_user->save();

        $role_admin=new Role();
        $role_admin->name='Administrador';
        $role_admin->description='El administrador';
        $role_admin->save();

        $role_labo=new Role();
        $role_labo->name='Laboratorio';
        $role_labo->description='Un usuario del laboratorio';
        $role_labo->save();
    }
}
