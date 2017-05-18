<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Asociacion;
use Illuminate\Support\Facades\Auth;

class AsociacionesController extends Controller
{
    //
    public function index(){

      $asociaciones=Asociacion::all();
      return $asociaciones;

    }

    public function registrar(){

      return view('asociacion.registrarAsociacion');
    }

    public function guardar(Request $request){
      $this->validate($request,[
        'nombre'=>['required','max:100'],
        'direccion'=>['required'],
        'email'=>['required'],
        'telefono'=>['required'],
      ]);
      $datos = $request->all();
      Asociacion::create($datos);
      return redirect()->to('/ver/asociacion');
    }

    public function show($Asociacion=null){
        $usuario=Auth::user();
        if ($usuario->asociacion!=null){

            $Asociacion=$usuario->asociacion->id;
            //dd($Asociacion);
        }
        if($Asociacion==null){

            $asociaciones=Asociacion::all();
            return view('asociacion.verAsociaciones',compact('asociaciones'));

        }else{
            return $this->show_detail($Asociacion);
        }

    }
    public function show_detail($Asociacion){

    //dd(Ganado::find($Ganado));
    $asociacion=Asociacion::find($Asociacion);
    $ganaderias=$asociacion->ganaderias;
    return view('asociacion.verAsociacion', compact('asociacion','ganaderias'));

    }
    public function show_edit($Asociacion){

        $asociacion=Asociacion::find($Asociacion);
        return view('asociacion.editarAsociacion', compact('asociacion'));

    }

    public function edit(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:100'],
            'direccion'=>['required'],
            'email'=>['required'],
            'asociacion_id'=>['required'],
            'telefono'=>['required'],
        ]);
        $datos = $request->except(['asociacion_id']);
        $asociacion_id=$request->input('asociacion_id');
        $asociacion=Asociacion::find($asociacion_id);
        $asociacion->fill($datos)->save();

        return redirect()->route('verasociacion',[$asociacion]);
        //return redirect('ver/asociacion/'.$asociacion_id);
    }

    public function delete($id, Request $request){

        if($request->ajax()){
            $asociacion=Asociacion::find($id);
            $asociacion->delete();
            return $id;

        }
        return redirect()->to('/ver/asociacion/');

    }
}
