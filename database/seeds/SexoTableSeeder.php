<?php

use App\Sexo;
use Illuminate\Database\Seeder;

class SexoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Sexo::create(['nombre'=>'Macho']);
        Sexo::create(['nombre'=>'Hembra']);
    }
}