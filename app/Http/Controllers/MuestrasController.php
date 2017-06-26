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

            }else {
                $muestras = Muestra::all()->sortBy('tubo');
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
    public function show_edit($Ganado){

        $ganadoe=Ganado::find($Ganado);
        $ganados=Ganado::all()->sortBy('crotal');
        $sexos=Sexo::all();
        $ganaderias=Ganaderia::lists('nombre','id');
        session()->put('url.intended', URL::previous());

        return view('ganado.editarGanado', compact('ganados','ganadoe','sexos','ganaderias'));

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
        return Redirect::intended('/');
        //return redirect()->route('verganado',[$ganado]);
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
