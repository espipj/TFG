<?php

use App\Ganado;
use App\Laboratorio;
use App\Muestra;
use App\TipoConsulta;
use App\TipoMuestra;
use Illuminate\Database\Seeder;

class MuestraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $muestras = factory(Muestra::class)->times(60)->make();
        $ganados= Ganado::all();
        $tipomuestras= TipoMuestra::all();
        $tipoconsultas= TipoConsulta::all();
        $laboratorios= Laboratorio::all();

        foreach ($muestras as $muestra){
            $muestra->setGanado($ganados->random());
            $muestra->setLaboratorio($laboratorios->random());
            $muestra->setTipoConsulta($tipoconsultas->random());
            $muestra->setTipoMuestra($tipomuestras->random());
        }
    }
}
