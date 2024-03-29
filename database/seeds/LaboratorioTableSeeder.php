<?php

use App\Laboratorio;
use Illuminate\Database\Seeder;

class LaboratorioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Laboratorio::create([
                'nombre'    =>  'Innovagenomics',
                'direccion' =>  'Parque Científico USAL, Edif. CIALE Lab 4, C/ Del Duero s/n, 37185, Villamayor, Salamanca',
                'email'     =>  'innovagenomics@gmail.com',
                'telefono'  =>  '675 686 587'
        ]);

        factory(Laboratorio::class)->times(5)->create();
    }
}
