<?php

use App\Estado;
use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Estado::create([
            'nombre'    =>  'Vivo',
            'alias'     =>  'V']);
        Estado::create([
            'nombre'    =>  'Muerto',
            'alias'     =>  'M']);
    }
}
