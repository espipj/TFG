<?php

namespace App\Http\Controllers;

use App\Asociacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
    //
    public function index(){
        $asociaciones=Asociacion::all();
        return view('asociacion.verAsociaciones',compact('asociaciones'));
    }
}
