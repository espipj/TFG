<?php

namespace App\Http\Controllers;

use App\Ganaderia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GanaderiasController extends Controller
{
    //
    public function index(){
        return Ganaderia::all();
    }
    public function registrar(){

        return view('registrarGanaderia');
    }

    public function guardar(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:256'],
            'direccion'=>['required','max:256'],
        ]);
        $datos = $request->all();
        Ganaderia::create($datos);
        return redirect()->to('/ver/ganaderia');
    }

    public function show($Ganaderia=null){
        if($Ganaderia==null){
            return Ganaderia::all();
            //return view('asociaciones');
        }else {
            dd($Ganaderia);
        }
    }
}
