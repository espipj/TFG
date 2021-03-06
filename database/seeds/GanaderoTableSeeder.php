<?php

use App\Ganaderia;
use App\Ganadero;
use Illuminate\Database\Seeder;

class GanaderoTableSeeder extends Seeder
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
        $ganaderos = factory(Ganadero::class)->times(100)->make();

        foreach ($ganaderos as $ganadero){
            $ganaderia = $ganaderias->random();
            $ganaderia->ganaderos()->save($ganadero);
        }
    }
}
