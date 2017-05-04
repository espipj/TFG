<?php

use App\TipoConsulta;
use Illuminate\Database\Seeder;

class TipoConsultaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipoConsulta::create([
            'nombre'    =>  'Genotipado'
        ]);

        TipoConsulta::create([
            'nombre'    =>  'Filiación Padre'
        ]);

        TipoConsulta::create([
            'nombre'    =>  'Filiación Progenitores'
        ]);

        TipoConsulta::create([
            'nombre'    =>  'Translocación Robertsoniana'
        ]);
    }
}
