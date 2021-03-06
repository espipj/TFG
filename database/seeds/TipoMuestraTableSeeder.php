<?php

use App\TipoMuestra;
use Illuminate\Database\Seeder;

class TipoMuestraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipoMuestra::create([
            'nombre'    =>  'Sangre'
        ]);

        TipoMuestra::create([
            'nombre'    =>  'Pelo'
        ]);

        TipoMuestra::create([
            'nombre'    =>  'Semen Fresco'
        ]);

        TipoMuestra::create([
            'nombre'    =>  'Semen Congelado'
        ]);

        TipoMuestra::create([
            'nombre'    =>  'Lana'
        ]);

        TipoMuestra::create([
            'nombre'    =>  'Otro'
        ]);
    }
}
