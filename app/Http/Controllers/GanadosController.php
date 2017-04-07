<?php

namespace App\Http\Controllers;

use App\Ganaderia;
use App\Ganado;
use App\Sexo;
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

        $ganaderias=Ganaderia::all();
        $sexos=Sexo::all();
        return view('registrarGanado',compact('ganaderias','sexos'));
    }

    public function guardar(Request $request){
        $this->validate($request,[
            'crotal'=>['required','max:256'],
            'sexo_id'=>['required'],
            'fecha_nacimiento'=>['required'],
            'ganaderia_id'=>['required'],
        ]);
        $datos = $request->except(['ganaderia_id','sexo_id']);
        $ganado=Ganado::create($datos);
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $sexo=Sexo::find($request->input('sexo_id'));
        //$ganaderia=$request->input('ganaderia_id');
        $ganaderia->ganados()->save($ganado);
        $sexo->ganados()->save($ganado);
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
