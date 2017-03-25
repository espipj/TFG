<?php

namespace App\Http\Controllers;

use App\Ganadero;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GanaderosController extends Controller
{
    //
    public function index(){
        return Ganadero::all();
    }
    public function registrar(){

        return view('registrarGanadero');
    }

    public function guardar(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:256'],
            'apellido1'=>['required','max:256'],
            'apellido2'=>['required','max:256'],
            'dni'=>['required','max:256'],
            'email'=>['required','max:256'],
            'telefono'=>['required','max:14'],
        ]);
        $datos = $request->all();
        Ganadero::create($datos);
        return redirect()->to('/ver/ganadero');
    }

    public function show($Asociacion=null){
        if($Asociacion==null){
            return Ganadero::all();
            //return view('asociaciones');
        }else {
            dd($Asociacion);
        }
    }
}
