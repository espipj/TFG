<?php

namespace App\Http\Controllers;

use App\Ganado;
use App\Gen;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $usuario=Auth::user();
        if ($usuario->hasAnyRole(array('Administrador','SuperAdmin','Laboratorio'))){
            $permiso="conpermiso";
        }else{
            $permiso="sinpermiso";
        }
        return view('genes.verGenes',compact('permiso'));
    }


    public function Marcador($marcador){
            dd(Gen::posicionMarcador($marcador));
    }

    public function Frecuencia($alelo,$marcador){
        dd(Gen::calcularFrecuenciaAlelo($alelo,$marcador));
    }

    public function Filiar(){

        $usuario=Auth::user();
        if ($usuario->hasAnyRole(array('SuperAdmin','Laboratorio'))){
            $permiso="conpermiso";
        }else{
            $permiso="sinpermiso";
        }
        return view('genes.filiarGanado',compact('permiso','ganado'));
    }
}
