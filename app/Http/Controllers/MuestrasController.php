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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

/**
 * Class MuestrasController
 *
 * Controller of Muestra Model.
 *
 * @package App\Http\Controllers
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class MuestrasController extends Controller
{

    /**
     * Function that returns the view to register a Muestra.
     *
     * @param integer $Ganado Optional: id of the Ganado which the Muestra is from.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View of the Muestra registration form.
     */
    public function registrar($Ganado=null){
        session()->put('url.intended', URL::previous());
        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        $ganados=Ganado::all()->sortBy('crotal');
        $tipomuestras=TipoMuestra::all()->sortBy('select_option')->lists('select_option','id');
        $tipoconsultas=TipoConsulta::all()->sortBy('select_option')->lists('select_option','id');
        $laboratorios=Laboratorio::all()->sortBy('select_option')->lists('select_option','id');
        if($Ganado==null){
            return view('muestra.registrarMuestra',compact('ganaderias','ganados','tipomuestras','tipoconsultas','laboratorios'));

        }else{
            return view('muestra.registrarMuestra',compact('ganaderias','ganados','tipomuestras','tipoconsultas','laboratorios'));

        }
    }

    /**
     * Called function from a POST request in order to save an Muestra.
     *
     * It check the requests input values from the form.
     *
     * @param Request $request Input values from the form.
     * @return \Illuminate\Http\RedirectResponse Redirects to the detail of the Muestra we've just create.
     */
    public function guardar(Request $request){
        $this->validate($request,[
            'tubo'=>['required','numeric'],
            'fecha_extraccion'=>['required','date'],
            'ganado_id'=>['required'],
            'tipo_muestra_id'=>['required'],
            'tipo_consulta_id'=>['required'],
            'laboratorio_id'=>['required'],
        ]);
        $muestra=Muestra::guardarNueva($request);
        return redirect()->route('vermuestra',[$muestra]);
    }

    /**
     * This function shows us the view of Muestra Model.
     *
     * Depending on if we've asked for a specific Muestra or not, it will show us the details view or a listing of
     * all the elements in the Muestra model.
     * It check as well the role of the user in order to show the info it must see.
     *
     * @param integer $Explotacion This parameter appears when we ask for a specific Muestra.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Returns the view of Muestra listing.
     */
    public function show($Muestra=null){
        $descripcion="Desde esta página puedes registrar una nueva muestra o editar las ya existentes y listadas.";
        $usuario=Auth::user();
        if($Muestra==null){
            if ($usuario->hasAnyRole('Laboratorio')){
                if($usuario->laboratorio!=null){
                    $laboratorio=$usuario->laboratorio;
                    $muestras=$laboratorio->muestras->sortBy('tubo');
                    return view('muestra.verMuestras', compact('muestras','descripcion'));
                }else{
                    $muestras="nomuest";
                    return view('muestra.verMuestras', compact('muestras','descripcion'));

                }

            }else if ($usuario->hasAnyRole('SuperAdmin')){
                $muestras=Muestra::all();
                return view('muestra.verMuestras', compact('muestras','descripcion'));
            }else {
                if (isset($usuario->asociacion)){
                    $muestras = Muestra::muestrasAsociacion($usuario->asociacion);

                }else{
                    $muestras="nomuest";
                }
                return view('muestra.verMuestras', compact('muestras','descripcion'));
            }
        }else{
            return $this->show_detail($Muestra);
        }
    }

    /**
     * Function to show the details of a specific Muestra.
     *
     * @param integer $Explotacion id of the Muestra we want to see details.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View of the details of the Muestra.
     */
    public function show_detail($Muestra){
        $muestra=Muestra::find($Muestra);
        return view('muestra.verMuestra', compact('muestra'));
    }


    /**
     * Function that show the edition form of an Muestra.
     *
     * @param integer $Explotacion id of the Muestra we want to edit.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_edit($Muestra){
        session()->put('url.intended', URL::previous());
        $muestra=Muestra::find($Muestra);
        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        $ganados=Ganado::all()->sortBy('crotal');
        $tipomuestras=TipoMuestra::all()->sortBy('select_option')->lists('select_option','id');
        $tipoconsultas=TipoConsulta::all()->sortBy('select_option')->lists('select_option','id');
        $laboratorios=Laboratorio::all()->sortBy('select_option')->lists('select_option','id');

        return view('muestra.editarMuestra', compact('muestra','ganaderias','ganados','tipomuestras','tipoconsultas','laboratorios'));


    }

    /**
     * Function that saves the changes of the edited Muestra.
     *
     * Receives a POST request with the form input data, check the values and save the changes of the Muestra.
     *
     * @param Request $request Input values in the edit Muestra form.
     * @return \Illuminate\Http\RedirectResponse Redirects to where the user was before hitting the edit button.
     */
    public function edit(Request $request){
        $this->validate($request,[
            'tubo'=>['required','numeric'],
            'fecha_extraccion'=>['required','date'],
            'ganado_id'=>['required'],
            'tipo_muestra_id'=>['required'],
            'tipo_consulta_id'=>['required'],
            'laboratorio_id'=>['required'],
            'muestra_id'=>['required'],
        ]);
        $datos = $request->except(['ganado_id','tipo_muestra_id','tipo_consulta_id','laboratorio_id','muestra_id','fecha_extraccion']);
        $muestra=Muestra::find($request->input('muestra_id'));
        $muestra->fill($datos)->save();



        $muestra->setFechaExtraccion($request->input('fecha_extraccion'));
        $muestra->setGanado(Ganado::find($request->input('ganado_id')));
        $muestra->setLaboratorio(Laboratorio::find($request->input('laboratorio_id')));
        $tconsulta=TipoConsulta::find($request->input('tipo_consulta_id'));
        $muestra->setTipoConsulta($tconsulta);
        $muestra->setTipoMuestra(TipoMuestra::find($request->input('tipo_muestra_id')));
        return Redirect::intended('/');
    }

    /**
     * Function that deletes a specific Muestra on our system.
     *
     * @param integer $id id of the Muestra we want to delete.
     * @param Request $request POST request that could be AJAX in this case.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, Request $request){
        if($request->ajax()){

            $muestra=Muestra::find($id);
            $muestra->delete();
            return $id;

        }


    }
}
