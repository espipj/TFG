<?php

namespace App\Http\Controllers;

use App\Laboratorio;
use App\TipoConsulta;
use App\TipoMuestra;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MuestrasController extends Controller
{
    //

    public function index(){
        return Ganado::all()->sortBy('crotal');
    }
    public function registrar($Ganado=null){

        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        $ganados=Ganado::all()->sortBy('crotal');
        $tipomuestras=TipoMuestra::all()->sortBy('select_option')->lists('select_option',id);
        $tipoconsultas=TipoConsulta::all()->sortBy('select_option')->lists('select_option',id);
        $laboratorios=Laboratorio::all()->sortBy('select_option')->lists('select_option',id);
        if($Ganado==null){
            return view('muestra.registrarMuestra',compact('ganaderias','ganados','tipomuestras','tipoconsultas','laboratorios'));

        }else{
            return view('ganado.registrarGanado',compact('ganaderias','sexos','Ganaderia','ganados'));

        }
    }

    public function guardar(Request $request){
        $this->validate($request,[
            'crotal'=>['required','max:256'],
            'sexo_id'=>['required'],
            'fecha_nacimiento'=>['required'],
            'ganaderia_id'=>['required'],
        ]);
        Ganado::guardarNuevo($request);
        return redirect()->to('/ver/ganado');
    }

    public function show($Ganado=null){
        if($Ganado==null){
            $ganados=Ganado::all()->sortBy('crotal')->sortByDesc('vivo');
            //$ganados=Ganado::where('vivo',1)->orderBy('crotal')->get();
            return view('ganado.verGanados',compact('ganados'));
        }else{
            return $this->show_detail($Ganado);
        }
    }

    public function showMuertos($Ganaderia=null){

        if($Ganaderia==null){
            $ganados=Ganado::where('vivo',0)->orderBy('crotal')->get();

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
