<?php

namespace App\Http\Controllers;

use App\Ganaderia;
use App\Ganado;
use App\Laboratorio;
use App\Muestra;
use App\TipoConsulta;
use App\TipoMuestra;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MuestrasController extends Controller
{
    //

    public function index(){
        return Ganado::all()->sortBy('crotal');
    }
    public function registrar($Ganado=null){

        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        $ganados=Ganado::all()->sortBy('crotal');
        $tipomuestras=TipoMuestra::all()->sortBy('select_option')->lists('select_option','id');
        $tipoconsultas=TipoConsulta::all()->sortBy('select_option')->lists('select_option','id');
        $laboratorios=Laboratorio::all()->sortBy('select_option')->lists('select_option','id');
        if($Ganado==null){
            return view('muestra.registrarMuestra',compact('ganaderias','ganados','tipomuestras','tipoconsultas','laboratorios'));

        }else{
            return view('ganado.registrarGanado',compact('ganaderias','sexos','Ganaderia','ganados'));

        }
    }

    public function guardar(Request $request){
        $this->validate($request,[
            'tubo'=>['required'],
            'fecha_extraccion'=>['required'],
            'ganado_id'=>['required'],
            'tipo_muestra_id'=>['required'],
            'tipo_consulta_id'=>['required'],
            'laboratorio_id'=>['required'],
        ]);
        $muestra=Muestra::guardarNueva($request);
        return redirect()->route('vermuestra',[$muestra]);
    }

    public function show($Muestra=null){
        $usuario=Auth::user();
        if($Muestra==null){
            if ($usuario->hasAnyRole('Laboratorio')){
                if($usuario->laboratorio!=null){
                    $laboratorio=$usuario->laboratorio;
                    $muestras=$laboratorio->muestras->sortBy('tubo');
                    return view('muestra.verMuestras', compact('muestras'));
                }else{
                    $muestras="nomuest";
                    return view('muestra.verMuestras', compact('muestras'));

                }

            }else {
                $muestras = Muestra::all()->sortBy('tubo');
                return view('muestra.verMuestras', compact('muestras'));
            }
        }else{
            return $this->show_detail($Muestra);
        }
    }

    public function show_detail($Muestra){
        $muestra=Muestra::find($Muestra);
        return view('muestra.verMuestra', compact('muestra'));
    }


    public function show_edit($Ganado){

        $ganadoe=Ganado::find($Ganado);
        $ganados=Ganado::all()->sortBy('crotal');
        $sexos=Sexo::all();
        $ganaderias=Ganaderia::lists('nombre','id');
        return view('ganado.editarGanado', compact('ganados','ganadoe','sexos','ganaderias'));



    }

    public function edit(Request $request){
        $this->validate($request,[
            'crotal'=>['required','max:256'],
            'sexo_id'=>['required'],
            'fecha_nacimiento'=>['required'],
            'ganaderia_id'=>['required'],
            'ganado_id'=>['required'],
        ]);
        $datos = $request->except(['ganaderia_id','sexo_id','ganado_id','fecha_nacimiento']);
        $ganado=Ganado::find($request->input('ganado_id'));
        $padre=Ganado::find($request->input('padre_id'));
        $madre=Ganado::find($request->input('madre_id'));
        $padre->hijosP()->save($ganado);
        $madre->hijosM()->save($ganado);
        $ganado->fill($datos)->save();
        $ganado->fecha_nacimiento=$request->input('fecha_nacimiento');
        $ganado->save();
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $sexo=Sexo::find($request->input('sexo_id'));
        $ganaderia->ganados()->save($ganado);
        $sexo->ganados()->save($ganado);
        return redirect()->route('verganado',[$ganado]);
    }

    public function delete($id,Request $request){
        if($request->ajax()){

            $ganado=Ganado::find($id);
            $ganado->fill(['vivo'=>0])->save();
            return $id;

        }


    }
}
