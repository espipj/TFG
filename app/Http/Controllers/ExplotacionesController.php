<?php

namespace App\Http\Controllers;

use App\Explotacion;
use App\Ganaderia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExplotacionesController extends Controller
{
    //
    public function index(){
        return Ganado::all();
    }
    public function registrar($Ganaderia=null){

        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        if($Ganaderia==null){
            return view('explotacion.registrarExplotacion',compact('ganaderias','sexos'));

        }else{
            return view('explotacion.registrarExplotacion',compact('ganaderias','sexos','Ganaderia'));

        }
    }

    public function guardar(Request $request){
        $this->validate($request,[
            'codigo_explotacion'=>['required'],
            'municipio'=>['required'],
            'ganaderia_id'=>['required'],
        ]);
        $datos = $request->except('ganaderia_id');
        $explotacion=Explotacion::create($datos);
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganaderia->explotaciones()->save($explotacion);
        return redirect()->route('verexplotacion',[$explotacion]);
    }

    public function show($Explotacion=null){
        $usuario=Auth::user();
        if($Explotacion==null){
            if($usuario->hasAnyRole(array('SuperAdmin'))){
                $explotaciones=Explotacion::all();

            }elseif ($usuario->hasAnyRole(array('Administrador'))){
                if ($usuario->asociacion != null) {

                    $asociacion = $usuario->asociacion;

                    $explotaciones = $asociacion->explotaciones;
                }else{
                    $explotaciones="noexp";

                }

            }elseif ($usuario->hasAnyRole(array('Ganadero'))){
                if ($usuario->ganaderia != null) {

                    $explotaciones=$usuario->ganaderia->explotaciones;
                }else{
                    $explotaciones="noexp";

                }

            }else{
                $explotaciones="noexp";
            }

            return view('explotacion.verExplotaciones',compact('explotaciones'));
        }else{
            return $this->show_detail($Explotacion);
        }
    }

    public function show_detail($Explotacion){
        $explotacion=Explotacion::find($Explotacion);
        return view('explotacion.verExplotacion', compact('explotacion'));
    }

    public function show_edit($Explotacion){

        $explotacion=Explotacion::find($Explotacion);
        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        return view('explotacion.editarExplotacion', compact('explotacion','ganaderias'));



    }

    public function edit(Request $request){
        $this->validate($request,[
            'codigo_explotacion'=>['required'],
            'municipio'=>['required'],
            'ganaderia_id'=>['required'],
            'explotacion_id'=>['required'],
        ]);
        $datos = $request->except(['ganaderia_id','explotacion_id']);
        $explotacion=Explotacion::find($request->input('explotacion_id'));
        $explotacion->fill($datos)->save();
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganaderia->explotaciones()->save($explotacion);
        return redirect()->route('verexplotacion',[$explotacion]);
    }

    public function delete($id,Request $request){
        if($request->ajax()){

            $explotacion=Explotacion::find($id);
            $explotacion->delete();
            return $id;

        }


    }
}
