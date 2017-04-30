<?php

use App\Ganaderia;
use App\Ganado;
use App\Sexo;
use Illuminate\Database\Seeder;

class GanadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $ganaderias= Ganaderia::all();
        $sexos= Sexo::all();
        $ganados = factory(Ganado::class)->times(200)->make();

        foreach ($ganados as $ganado){
            $ganaderia = $ganaderias->random();
            $ganaderia->ganados()->save($ganado);
            $sexos->random()->ganados()->save($ganado);
            $padre=$ganados->random();
            $madre=$ganados->random();
            $ganado->madre()->associate($madre);
            $ganado->padre()->associate($padre);
            //$madre->hijosM()->save($ganado);
            //$padre->hijosP()->save($ganado);

        }
    }
}
