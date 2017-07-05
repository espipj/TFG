<?php

use App\Asociacion;
use App\Ganaderia;
use App\Laboratorio;
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
        $role_sadmin= Role::where('name','SuperAdmin')->first();
        $role_labo= Role::where('name','Laboratorio')->first();
        $admin=User::create([
            'name' => 'admin',
            'email' => 'admin@tfg.com',
            'password' => bcrypt('admin'),
        ]);
        $admin->roles()->attach($role_admin);
        $sadmin=User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@tfg.com',
            'password' => bcrypt('superadmin'),
        ]);
        $sadmin->roles()->attach($role_sadmin);
        $ganadero=User::create([
            'name' => 'ganadero',
            'email' => 'ganadero@tfg.com',
            'password' => bcrypt('ganadero'),
        ]);
        $ganadero->roles()->attach($role_gana);

        $ganadero->ganaderia()->associate(Ganaderia::find(1));
        $ganadero->save();
        $asociacion=User::create([
            'name' => 'asociacion',
            'email' => 'asociacion@tfg.com',
            'password' => bcrypt('asociacion'),
        ]);
        $asociacion->roles()->attach($role_admin);
        $asociacion->asociacion()->associate(Asociacion::find(1));
        $asociacion->save();
        $laboratorio=User::create([
            'name' => 'laboratorio',
            'email' => 'laboratorio@tfg.com',
            'password' => bcrypt('laboratorio'),
        ]);

        $laboratorio->roles()->attach($role_labo);

        $laboratorio->laboratorio()->associate(Laboratorio::find(1));
        $laboratorio->save();

    }
}
