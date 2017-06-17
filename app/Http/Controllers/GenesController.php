<?php

namespace App\Http\Controllers;

use App\Ganado;
use App\Gen;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class GenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $usuario = Auth::user();
        if ($usuario->hasAnyRole(array('Administrador', 'SuperAdmin', 'Laboratorio'))) {
            $permiso = "conpermiso";
        } else {
            $permiso = "sinpermiso";
        }
        return view('genes.verGenes', compact('permiso'));
    }


    public function Marcador($marcador)
    {
        dd(Gen::posicionMarcador($marcador));
    }

    public function Frecuencia($alelo, $marcador)
    {
        dd(Gen::calcularFrecuenciaAlelo($alelo, $marcador));
    }

    public function Filiar(Request $request)
    {
        $this->validate($request, [
            'ganado_id' => ['required'],
            'consulta' => ['required'],
        ]);

        $usuario = Auth::user();
        if ($usuario->hasAnyRole(array('SuperAdmin', 'Laboratorio'))) {
            $permiso = "conpermiso";
        } else {
            $permiso = "sinpermiso";
        }


        $ganado=Ganado::find($request->input('ganado_id'));
        $ganadosf=array();

        //dd($ganado->madre->gen);
        if(isset($ganado->madre->gen)){
            array_push($ganadosf,["Madre",$ganado->madre]);
        }

        if(isset($ganado->padre->gen)){
            array_push($ganadosf,["Padre",$ganado->padre]);
        }
        if(isset($ganado->gen)){
            array_push($ganadosf,["Hijo",$ganado]);
        }

        if ($request->input('consulta')=="sinpadre"){

            $resultados=Gen::calcularProbabilidadSP($ganado->madre->gen,$ganado->gen);
            //dd($resultados);
            $resimp=array();
            foreach ($resultados as $key=>$resultado){
                array_push($resimp,array("ganado"=>$resultado[1],"porcentaje"=>number_format($resultado[0][2]*100,2,',','')));
                if ($key==2) break;
            }
            //dd($resimp);
            return view('genes.resultadoFiliacionSP',compact('permiso','resimp','ganado','ganadosf'));
        }else{

            $resultado=Gen::calcularProbabilidad($ganado->padre->gen,$ganado->madre->gen,$ganado->gen);
            $porcentaje=$resultado[2]*100;
            $porcentaje=number_format($porcentaje,2,',','');

            return view('genes.resultadoFiliacionP',compact('permiso','resultado','porcentaje','ganado','ganadosf'));
        }

        return view('genes.filiarGanado', compact('permiso', 'ganado'));
    }

    public function anadirGenes($Ganado = null)
    {
        $usuario = Auth::user();
        if ($usuario->hasAnyRole(array('SuperAdmin', 'Laboratorio'))) {
            $permiso = "conpermiso";
        } else {
            $permiso = "sinpermiso";
        }

        $ganado = Ganado::find($Ganado);
        session()->put('url.intended', URL::previous());
        return view('genes.inputGenes', compact('ganado', 'permiso'));
    }

    public function anadirGenesPost(Request $request)
    {
        $this->validate($request, [
            'tgla227_1' => ['required'],
            'tgla227_2' => ['required'],
            'tgla53_1' => ['required'],
            'tgla53_2' => ['required'],
            'eth10_1' => ['required'],
            'eth10_2' => ['required'],
            'sps115_1' => ['required'],
            'sps115_2' => ['required'],
            'tgla126_1' => ['required'],
            'tgla126_2' => ['required'],
            'tgla122_1' => ['required'],
            'tgla122_2' => ['required'],
            'inra023_1' => ['required'],
            'inra023_2' => ['required'],
            'bm1818_1' => ['required'],
            'bm1818_2' => ['required'],
            'eth3_1' => ['required'],
            'eth3_2' => ['required'],
            'eth225_1' => ['required'],
            'eth225_2' => ['required'],
            'bm1824_1' => ['required'],
            'bm1824_2' => ['required'],
            'bm2113_1' => ['required'],
            'bm2113_2' => ['required'],
            'ganado_id' => ['required'],
        ]);

        $ganado=Ganado::find($request->input('ganado_id'));
        if(isset($ganado->gen)){

            $ganado->gen->delete();
        }
        $datos=$request->except('ganado_id');
        //dd($datos['tgla227_1']);
        $gen=Gen::create([
            'nombres'   =>  array('TGLA227','BM2113','TGLA53','ETH10','SPS115','TGLA126','TGLA122','INRA23','BM1818','ETH3','ETH225','BM1824'),
            'marcadores'=>  array(
                array($datos['tgla227_1'],$datos['tgla227_2']),
                array($datos['bm2113_1'],$datos['bm2113_2']),
                array($datos['tgla53_1'],$datos['tgla53_2']),
                array($datos['eth10_1'],$datos['eth10_2']),
                array($datos['sps115_1'],$datos['sps115_2']),
                array($datos['tgla126_1'],$datos['tgla126_2']),
                array($datos['tgla122_1'],$datos['tgla122_2']),
                array($datos['inra023_1'],$datos['inra023_2']),
                array($datos['bm1818_1'],$datos['bm1818_2']),
                array($datos['eth3_1'],$datos['eth3_2']),
                array($datos['eth225_1'],$datos['eth225_2']),
                array($datos['bm1824_1'],$datos['bm1824_2'])),

        ]);

        $gen->asignarGanado($ganado);

        return Redirect::intended('/');
    }

    public function solicitudFiliacion($Ganado=null){
        $usuario = Auth::user();
        if ($usuario->hasAnyRole(array('SuperAdmin', 'Laboratorio'))) {
            $permiso = "conpermiso";
        } else {
            $permiso = "sinpermiso";
        }
        $ganado = Ganado::find($Ganado);
        $ganadosf=array();

        //dd($ganado->madre->gen);
        if(isset($ganado->madre->gen)){
            array_push($ganadosf,["Madre",$ganado->madre]);
        }

        if(isset($ganado->padre->gen)){
            array_push($ganadosf,["Padre",$ganado->padre]);
        }
        if(isset($ganado->gen)){
            array_push($ganadosf,["Hijo",$ganado]);
        }
        //dd($ganadosf);
        //session()->put('url.intended', URL::previous());
        return view('genes.solicitudFiliacion', compact('ganado', 'permiso','ganadosf'));
    }
}
