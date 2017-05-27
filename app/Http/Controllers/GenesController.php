<?php

namespace App\Http\Controllers;

use App\Ganado;
use App\Gen;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $permiso="conpermiso";
        return view('genes.importarGenes',compact('permiso'));
    }


    public function Marcador($marcador){
            dd(Gen::posicionMarcador($marcador));
    }

    public function Frecuencia($alelo,$marcador){
        dd(Gen::calcularFrecuenciaAlelo($alelo,$marcador));
    }

    public function Filiar(){
        dd(Gen::calcularProbabilidad(Ganado::find(202)->gen,Ganado::find(201)->gen,Ganado::find(203)->gen));
    }
}
