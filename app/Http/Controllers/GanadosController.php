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

    public function show(){
            $ganados=Ganado::all();
            return view('verGanados',compact('ganados'));
    }

    public function show_detail(Request $request){

        //dd(Ganado::find($Ganado));
        $ganado=Ganado::find($request->input('ganado_id'));
        return view('verGanado', compact('ganado'));

    }

    public function show_edit(Request $request){

            $ganado=Ganado::find($request->input('ganado_id'));
            $sexos=Sexo::all();
            $ganaderias=Ganaderia::all();
            return view('editarGanado', compact('ganado','sexos','ganaderias'));

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
        return redirect()->to('/ver/ganado');
    }

    public function delete(Request $request){
            $ganado=Ganado::find($request->input('ganado_id'));
            $ganado->delete();
            return redirect()->to('/ver/ganado');

    }
}
