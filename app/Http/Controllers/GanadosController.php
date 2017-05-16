<?php

namespace App\Http\Controllers;

use App\Capa;
use App\Estado;
use App\Ganaderia;
use App\Ganado;
use App\Sexo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GanadosController extends Controller
{
    //
    public function index(){
        return Ganado::all()->sortBy('crotal');
    }
    public function registrar($Ganaderia=null){

        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        $capas=Capa::all()->sortBy('select_option')->lists('select_option','id');
        $ganados=Ganado::all()->sortBy('crotal');
        $sexos=Sexo::all();
        if($Ganaderia==null){
            return view('ganado.registrarGanado',compact('ganaderias','sexos','ganados','capas'));

        }else{
            return view('ganado.registrarGanado',compact('ganaderias','sexos','Ganaderia','ganados','capas'));

        }
    }

    public function guardar(Request $request){
        $this->validate($request,[
            'crotal'=>['required','max:256'],
            'sexo_id'=>['required'],
            'fecha_nacimiento'=>['required'],
            'ganaderia_id'=>['required'],
            'capa_id'=>['required'],
        ]);
        Ganado::guardarNuevo($request);
        return redirect()->to('/ver/ganado');
    }

    public function show($Ganado=null){
        if($Ganado==null){
            if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin'))){
                $ganados=Ganado::all()->sortBy('crotal')->sortBy('estado_id');
            }else{

                if(Auth::user()->ganaderia){
                    $ganados=Auth::user()->ganaderia->ganados->sortBy('crotal')->sortBy('estado_id');
                }else{
                    $ganados=collect(new Ganado);

                }

            }


            return view('ganado.verGanados',compact('ganados'));
        }else{
            return $this->show_detail($Ganado);
        }
    }

    public function showMuertos($Ganaderia=null){

        if($Ganaderia==null){
            $ganados=Ganado::where('estado_id',2)->orderBy('crotal')->get();

            //dd($ganados);
            return view('ganado.verGanados',compact('ganados'));

        }else{
           // return view('ganado.registrarGanado',compact('ganaderias','sexos','Ganaderia','ganados'));

        }
    }

    public function show_detail($Ganado){
        $ganado=Ganado::find($Ganado);
        if($ganado->sexo->nombre=='Macho'){
            $ganados=$ganado->hijosP;
        }else{
            $ganados=$ganado->hijosM;

        }
        return view('ganado.verGanado', compact('ganado','ganados'));
    }

    public function show_edit($Ganado){

        $ganadoe=Ganado::find($Ganado);
        $ganados=Ganado::all()->sortBy('crotal');
        $capas=Capa::all()->sortBy('select_option')->lists('select_option','id');
        $sexos=Sexo::all();
        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        return view('ganado.editarGanado', compact('ganados','ganadoe','sexos','ganaderias','capas'));



    }

    public function edit(Request $request){
        $this->validate($request,[
            'crotal'=>['required','max:256'],
            'sexo_id'=>['required'],
            'fecha_nacimiento'=>['required'],
            'ganaderia_id'=>['required'],
            'capa_id'=>['required'],
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
        $ganado->setCapa(Capa::find($request->input('capa_id')));
        return redirect()->route('verganado',[$ganado]);
    }

    public function delete($id,Request $request){
        if($request->ajax()){

            $ganado=Ganado::find($id);
            $muerto=Estado::where('nombre','Muerto')->first();
            $muerto->ganados()->save($ganado);
            return $id;

        }


    }
}
