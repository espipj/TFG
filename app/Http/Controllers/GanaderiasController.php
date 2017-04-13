<?php

namespace App\Http\Controllers;

use App\Asociacion;
use App\Ganaderia;
use App\Ganado;
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

        return view('ganaderia.registrarGanaderia');
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

    public function show(){
        $ganaderias=Ganaderia::all();
        return view('ganaderia.verGanaderias',compact('ganaderias'));
    }

    public function show_detail(Request $request){
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganados=$ganaderia->ganados;
        $ganaderos=$ganaderia->ganaderos;
        return view('ganaderia.verGanaderia', compact('ganaderia','ganados','ganaderos'));

    }

    public function show_edit(Request $request){

        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $asociaciones=Asociacion::all();
        return view('ganaderia.editarGanaderia', compact('ganaderia','asociaciones'));

    }

    public function edit(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:256'],
            'direccion'=>['required'],
            'ganaderia_id'=>['required'],
            'asociacion_id'=>['required'],
        ]);
        $datos = $request->except(['ganaderia_id','asociacion_id']);
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganaderia->fill($datos)->save();
        $asociacion=Asociacion::find($request->input('asociacion_id'));
        $asociacion->ganaderias()->save($ganaderia);
        return redirect()->to('/ver/ganaderia');
    }

    public function delete(Request $request){
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganaderia->delete();
        return redirect()->to('/ver/ganaderia');

    }
}
