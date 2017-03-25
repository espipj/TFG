<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Asociacion;

class AsociacionesController extends Controller
{
    //
    public function index(){

      $asociaciones=Asociacion::all();
      return $asociaciones;

    }

    public function registrar(){

      return view('registrarAsociacion');
    }

    public function guardar(Request $request){
      $this->validate($request,[
        'nombre'=>['required','max:100'],
        'direccion'=>['required'],
        'email'=>['required'],
      ]);
      $datos = $request->all();
      Asociacion::create($datos);
      return redirect()->to('/ver/asociacion');
    }

    public function show($Asociacion=null){
      if($Asociacion==null){
        return Asociacion::all();
        //return view('asociaciones');
      }else {
        dd($Asociacion);
      }
    }
}
