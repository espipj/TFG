<?php

namespace App\Http\Controllers;

use App\Ganaderia;
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
        $ganaderias=Ganaderia::all();
        return view('ganadero.registrarGanadero', compact('ganaderias'));
    }

    public function guardar(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:256'],
            'apellido1'=>['required','max:256'],
            'apellido2'=>['required','max:256'],
            'dni'=>['required','max:256'],
            'email'=>['required','max:256'],
            'telefono'=>['required','max:14'],
            'ganaderia_id'=>['required'],
        ]);
        $datos = $request->except('ganaderia_id');
        $ganadero=Ganadero::create($datos);
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganaderia->ganaderos()->save($ganadero);
        return redirect()->to('/ver/ganadero');
    }

    public function show(){
        $ganaderos=Ganadero::all();
        return view('ganadero.verGanaderos',compact('ganaderos'));
    }

    public function show_detail(Request $request){

        $ganadero=Ganadero::find($request->input('ganadero_id'));
        $ganaderias=Ganaderia::all();
        return view('ganadero.verGanadero', compact('ganadero','ganaderias'));

    }

    public function show_edit(Request $request){

        $ganadero=Ganadero::find($request->input('ganadero_id'));
        $ganaderias=Ganaderia::all();
        return view('ganadero.editarGanadero', compact('ganadero','ganaderias'));

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
        $datos = $request->except(['ganaderia_id','ganadero_id']);
        $ganadero=Ganadero::find($request->input('ganadero_id'));
        $ganadero->fill($datos)->save();
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganaderia->ganados()->save($ganadero);
        return redirect()->to('/ver/ganadero');
    }

    public function delete(Request $request){

        $ganadero=Ganadero::find($request->input('ganadero_id'));
        $ganadero->delete();
        return redirect()->to('/ver/ganadero');

    }
}
