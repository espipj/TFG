<?php

use App\Asociacion;
use App\Ganaderia;
use Illuminate\Database\Seeder;

class GanaderiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $asociaciones = Asociacion::all();
        $ganaderias = factory(Ganaderia::class)->times(100)->make();

        foreach ($ganaderias as $ganaderia) {
            $asociacion = $asociaciones->random();
            $asociacion->ganaderias()->save($ganaderia);
        }
    }
}
