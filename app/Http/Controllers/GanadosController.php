<?php

namespace App\Http\Controllers;

use App\Ganado;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GanadosController extends Controller
{
    //
    public function index(){
        return Ganado::all();
    }
    public function registrar(){

        return view('registrarGanado');
    }

    public function guardar(Request $request){
        $this->validate($request,[
            'crotal'=>['required','max:256'],
            'sexo'=>['required','max:256'],
            'fecha_nacimiento'=>['required'],
        ]);
        $datos = $request->all();
        Ganado::create($datos);
        return redirect()->to('/ver/ganado');
    }

    public function show($Ganado=null){
        if($Ganado==null){
            $ganados=Ganado::all();
            return view('verGanados',compact('ganados'));
        }else {
            dd($Ganado);
        }
    }
}
