<?php

use Illuminate\Database\Seeder;

class ExplotacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ganaderias = \App\Ganaderia::all();
        $explotaciones = factory(\App\Explotacion::class)->times(300)->make();

        foreach ($explotaciones as $explotacion){
            $ganaderias->random()->explotaciones()->save($explotacion);
        }
    }
}
