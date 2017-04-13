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

      return view('asociacion.registrarAsociacion');
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

    public function show(){
        $asociaciones=Asociacion::all();
        return view('asociacion.verAsociaciones',compact('asociaciones'));

    }
    public function show_detail(Request $request){

    //dd(Ganado::find($Ganado));
    $asociacion=Asociacion::find($request->input('asociacion_id'));
    $ganaderias=$asociacion->ganaderias;
    return view('asociacion.verAsociacion', compact('asociacion','ganaderias'));

    }
    public function show_edit(Request $request){

        $asociacion=Asociacion::find($request->input('asociacion_id'));
        return view('asociacion.editarAsociacion', compact('asociacion'));

    }

    public function edit(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:100'],
            'direccion'=>['required'],
            'email'=>['required'],
            'asociacion_id'=>['required'],
        ]);
        $datos = $request->except(['asociacion_id']);
        $asociacion=Asociacion::find($request->input('asociacion_id'));
        $asociacion->fill($datos)->save();
        return redirect()->to('/ver/asociacion');
    }

    public function delete(Request $request){
        $asociacion=Asociacion::find($request->input('asociacion_id'));
        $asociacion->delete();
        return redirect()->to('/ver/asociacion');

    }
}
