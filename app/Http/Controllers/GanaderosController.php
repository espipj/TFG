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

    public function show(){
        $ganaderos=Ganadero::all();
        return view('verGanaderos',compact('ganaderos'));
    }

    public function show_detail(Request $request){

        $ganadero=Ganadero::find($request->input('ganadero_id'));
        $ganaderias=Ganaderia::all();
        return view('verGanadero', compact('ganadero','ganaderias'));

    }

    public function show_edit(Request $request){

        $ganadero=Ganadero::find($request->input('ganadero_id'));
        $ganaderias=Ganaderia::all();
        return view('editarGanadero', compact('ganadero','ganaderias'));

    }

    public function edit(Request $request){


        $this->validate($request,[
            'nombre'=>['required','max:256'],
            'apellido1'=>['required'],
            'apellido2'=>['required'],
            'email'=>['required'],
            'telefono'=>['required'],
            'ganadero_id'=>['required'],
            'ganaderia_id'=>['required'],
        ]);
        $datos = $request->except(['ganaderia_id','sexo_id','ganado_id']);
        $ganado=Ganado::find($request->input('ganado_id'));
        $ganado->fill($datos)->save();
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $sexo=Sexo::find($request->input('sexo_id'));
        //$ganaderia=$request->input('ganaderia_id');
        $ganaderia->ganados()->save($ganado);
        $sexo->ganados()->save($ganado);
        return redirect()->to('/ver/ganado');
    }

    public function delete(Request $request){

        $ganadero=Ganadero::find($request->input('ganadero_id'));
        $ganadero->delete();
        return redirect()->to('/ver/ganadero');

    }
}
