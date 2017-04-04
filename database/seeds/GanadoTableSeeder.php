<?php

use App\Ganaderia;
use App\Ganado;
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
        $ganados = factory(Ganado::class)->times(400)->make();

        foreach ($ganados as $ganado){
            $ganaderia = $ganaderias->random();
            $ganaderia->ganados()->save($ganado);
        }
    }
}
