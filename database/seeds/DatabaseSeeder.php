<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseSeeder
 * @author Pablo Espinosa <espipj@gmail.com>
 * @link https://laravel.com/docs/5.1/seeding Some info about Database Seeding
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * DataBase seeders combined with Faker/ModelFactory allow us to create a quick dataset to start working.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RoleTableSeeder::class);
        $this->call(LaboratorioTableSeeder::class);
        $this->call(AsociacionTableSeeder::class);
        $this->call(GanaderiaTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TipoConsultaTableSeeder::class);
        $this->call(CapaTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
        $this->call(TipoMuestraTableSeeder::class);
        $this->call(SexoTableSeeder::class);
        $this->call(ExplotacionTableSeeder::class);
        $this->call(GanadoTableSeeder::class);
        $this->call(GenTableSeeder::class);
        $this->call(MuestraTableSeeder::class);

        Model::reguard();

    }
}
