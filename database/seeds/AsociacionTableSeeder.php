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
        factory(Asociacion::class)->times(50)->create();
    }
}
