<?php

use App\Role;
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
        $role_gana= Role::where('name','Ganadero')->first();
        $role_admin= Role::where('name','Administrador')->first();
        $role_labo= Role::where('name','Laboratorio')->first();
        $admin=User::create([
            'name' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('admin'),
        ]);
        $admin->roles()->attach($role_admin);
        $ganadero=User::create([
            'name' => 'ganadero',
            'email' => 'ganadero',
            'password' => bcrypt('ganadero'),
        ]);
        $ganadero->roles()->attach($role_gana);
        $asociacion=User::create([
            'name' => 'asociacion',
            'email' => 'asociacion',
            'password' => bcrypt('asociacion'),
        ]);
        $asociacion->roles()->attach($role_admin);
        $laboratorio=User::create([
            'name' => 'laboratorio',
            'email' => 'laboratorio',
            'password' => bcrypt('laboratorio'),
        ]);

        $laboratorio->roles()->attach($role_labo);
    }
}
