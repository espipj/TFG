<?php

use App\Asociacion;
use Illuminate\Database\Seeder;

class AsociacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Asociacion::create([
            'nombre' => 'Morucha',
            'direccion' => 'Calle Santa Clara, 20 – 37001 SALAMANCA',
            'email' => 'morucha@morucha.com',
            'telefono' => '923 28 08 92',
        ]);
        //factory(Asociacion::class)->times(50)->create();
    }
}
