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
    public function registrar($Ganaderia=null){

        $ganaderias=Ganaderia::lists('nombre','id');
        $sexos=Sexo::all();
        if($Ganaderia==null){
            return view('ganado.registrarGanado',compact('ganaderias','sexos'));

        }else{
            return view('ganado.registrarGanado',compact('ganaderias','sexos','Ganaderia'));

        }
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
            return view('ganado.verGanados',compact('ganados'));
        }else{
            return $this->show_detail($Ganado);
        }
    }

    public function show_detail($Ganado){
        $ganado=Ganado::find($Ganado);
        return view('ganado.verGanado', compact('ganado'));
    }

    public function show_edit($Ganado){

        $ganado=Ganado::find($Ganado);
        $sexos=Sexo::all();
        $ganaderias=Ganaderia::lists('nombre','id');
        return view('ganado.editarGanado', compact('ganado','sexos','ganaderias'));



    }

    public function edit(Request $request){
        $this->validate($request,[
            'crotal'=>['required','max:256'],
            'sexo_id'=>['required'],
            'fecha_nacimiento'=>['required'],
            'ganaderia_id'=>['required'],
            'ganado_id'=>['required'],
        ]);
        $datos = $request->except(['ganaderia_id','sexo_id','ganado_id']);
        $ganado=Ganado::find($request->input('ganado_id'));
        $ganado->fill($datos)->save();
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $sexo=Sexo::find($request->input('sexo_id'));
        //$ganaderia=$request->input('ganaderia_id');
        $ganaderia->ganados()->save($ganado);
        $sexo->ganados()->save($ganado);
        return redirect()->route('verganado',[$ganado]);
    }

    public function delete($Ganado){

        $ganado=Ganado::find($Ganado);
        $ganado->delete();
        return redirect()->to('/ver/ganado');


    }
}
