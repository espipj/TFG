<?php

use App\Estado;
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
        $estados= Estado::all();
        $ganados = factory(Ganado::class)->times(200)->make();

        foreach ($ganados as $ganado){
            $ganaderia = $ganaderias->random();
            $ganaderia->ganados()->save($ganado);
            $sexos->random()->ganados()->save($ganado);
            $estados->random()->ganados()->save($ganado);

        }

        foreach ($ganados as $ganado) {
            $padre = $ganados->where('sexo_id', 1)->random();
            $madre = $ganados->where('sexo_id', 2)->random();
            $madre->hijosM()->save($ganado);
            $padre->hijosP()->save($ganado);
        }
    }
}
