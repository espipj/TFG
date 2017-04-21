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
    public function registrar($Asociacion = null){
        if($Asociacion==null){

            $asociaciones= Asociacion::lists('nombre','id');
            return view('ganaderia.registrarGanaderia',compact('asociaciones'));

        }else{

            $asociaciones= Asociacion::lists('nombre','id');
            return view('ganaderia.registrarGanaderia',compact('asociaciones','Asociacion'));
        }
    }

    public function guardar(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:256'],
            'direccion'=>['required','max:256'],
            'asociacion_id'=>['required']
        ]);
        $datos = $request->except('asociacion_id');
        $ganaderia=Ganaderia::create($datos);
        $asociacion=Asociacion::find($request->input('asociacion_id'));
        $asociacion->ganaderias()->save($ganaderia);
        return redirect()->to('/ver/ganaderia');
    }

    public function show($Ganaderia=null){
        if($Ganaderia==null){
            $ganaderias=Ganaderia::all();
            return view('ganaderia.verGanaderias',compact('ganaderias'));
        }else{
            return $this->show_detail($Ganaderia);
        }
    }

    public function show_detail($Ganaderia){
        $ganaderia=Ganaderia::find($Ganaderia);
        $ganados=$ganaderia->ganados;
        $ganaderos=$ganaderia->ganaderos;
        return view('ganaderia.verGanaderia', compact('ganaderia','ganados','ganaderos'));

    }

    public function show_edit($Ganaderia){

        $ganaderia=Ganaderia::find($Ganaderia);
        $asociaciones= Asociacion::lists('nombre','id');
        return view('ganaderia.editarGanaderia', compact('ganaderia','asociaciones'));

    }

    public function edit(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:256'],
            'direccion'=>['required','max:256'],
            'asociacion_id'=>['required'],
            'ganaderia_id' =>['required'],
        ]);
        $datos = $request->except('asociacion_id','ganaderia_id');
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganaderia->fill($datos)->save();
        $asociacion=Asociacion::find($request->input('asociacion_id'));
        $asociacion->ganaderias()->save($ganaderia);
        return redirect()->route('verganaderia',[$ganaderia]);
        //return redirect()->to('/ver/ganaderia');
    }

    public function delete($Ganaderia){
        $ganaderia=Ganaderia::find($Ganaderia);
        $ganaderia->delete();
        return redirect()->to('/ver/ganaderia');

    }
}
