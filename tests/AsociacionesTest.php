<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Asociacion;

class AsociacionesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_crearAsociacion()
    {
        Asociacion::create(['nombre'=>'Ejemplo de SL']);
        
    }
}
