<?php

use App\Capa;
use Illuminate\Database\Seeder;

class CapaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Capa::create([
            'nombre'    =>  'Morucha Cárdena',
            'alias'     =>  'C']);
        Capa::create([
            'nombre'    =>  'Morucha Negra',
            'alias'     =>  'N']);
    }
}