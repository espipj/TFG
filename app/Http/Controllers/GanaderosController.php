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
    public function registrar($Ganaderia=null){

        $ganaderias=Ganaderia::lists('nombre','id');
        if($Ganaderia==null){
            return view('ganadero.registrarGanadero', compact('ganaderias'));

        }else{
            return view('ganadero.registrarGanadero', compact('ganaderias','Ganaderia'));

        }
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

    public function show($Ganadero=null){
        if($Ganadero==null){
            $ganaderos=Ganadero::all();
            return view('ganadero.verGanaderos',compact('ganaderos'));

        }else{
            return $this->show_detail($Ganadero);
        }
    }

    public function show_detail($Ganadero){

        $ganadero=Ganadero::find($Ganadero);
        $ganaderias=Ganaderia::all();
        return view('ganadero.verGanadero', compact('ganadero','ganaderias'));

    }

    public function show_edit($Ganadero){

        $ganadero=Ganadero::find($Ganadero);
        $ganaderias=Ganaderia::lists('nombre','id');
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
        return redirect()->route('verganadero',[$ganadero]);
    }

    public function delete($id,Request $request){

        if($request->ajax()){
            $ganadero=Ganadero::find($id);
            $ganadero->delete();
            return $id;
            return redirect()->to('/ver/ganadero');

        }

    }
}
