<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(AsociacionTableSeeder::class);
        $this->call(SexoTableSeeder::class);
        $this->call(GanaderiaTableSeeder::class);
        $this->call(ExplotacionTableSeeder::class);
        $this->call(GanadoTableSeeder::class);
        //$this->call(GanaderoTableSeeder::class);

        Model::reguard();

    }
}
