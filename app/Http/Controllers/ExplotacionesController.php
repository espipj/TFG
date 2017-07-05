<?php

namespace App\Http\Controllers;

use App\Explotacion;
use App\Ganaderia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

/**
 * Class ExplotacionesController.
 *
 * Controller of Explotacion Model.
 * @package App\Http\Controllers
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class ExplotacionesController extends Controller
{

    /**
     * Used function for initial testing.
     *
     * @return mixed
     */
    public function index(){
        return Ganado::all();
    }

    /**
     * Function that returns the view to register an Explotacion.
     *
     * @param integer $Ganaderia Optional: id of the Ganaderia which is owner of the Explotacion.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View of the Explotacion registration form.
     */
    public function registrar($Ganaderia=null){
        session()->put('url.intended', URL::previous());
        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        if($Ganaderia==null){
            return view('explotacion.registrarExplotacion',compact('ganaderias','sexos'));

        }else{
            return view('explotacion.registrarExplotacion',compact('ganaderias','sexos','Ganaderia'));

        }
    }

    /**
     * Called function from a POST request in order to save an Explotacion.
     *
     * It check the requests input values from the form.
     *
     * @param Request $request Input values from the form.
     * @return \Illuminate\Http\RedirectResponse Redirects to where the user was before hitting the register button.
     */
    public function guardar(Request $request){
        $this->validate($request,[
            'codigo_explotacion'=>['required','string','unique:explotaciones'],
            'municipio'=>['required','string'],
            'ganaderia_id'=>['required'],
        ]);
        $datos = $request->except('ganaderia_id');
        $explotacion=Explotacion::create($datos);
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganaderia->explotaciones()->save($explotacion);

        return Redirect::intended('/');
        //return redirect()->route('verexplotacion',[$explotacion]);
    }

    /**
     * This function shows us the view of Explotacion Model.
     *
     * Depending on if we've asked for a specific Explotacion or not, it will show us the details view or a listing of
     * all the elements in the Explotacion model.
     * It check as well the role of the user in order to show the info it must see.
     *
     * @param integer $Explotacion This parameter appears when we ask for a specific Explotacion.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Returns the view of Explotacion listing.
     */
    public function show($Explotacion=null){
        $usuario=Auth::user();
        if($Explotacion==null){
            $explotaciones=Explotacion::explotacionesUser($usuario);
            return view('explotacion.verExplotaciones',compact('explotaciones'));
        }else{
            return $this->show_detail($Explotacion);
        }
    }

    /**
     * Function to show the details of a specific Explotacion.
     *
     * @param $Explotacion id of the Explotacion we want to see details.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View of the details of the Explotacion.
     */
    public function show_detail($Explotacion){
        $explotacion=Explotacion::find($Explotacion);
        return view('explotacion.verExplotacion', compact('explotacion'));
    }

    /**
     * Function that show the edition form of an Explotacion.
     *
     * @param $Explotacion id of the Explotacion we want to edit.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_edit($Explotacion){

        $explotacion=Explotacion::find($Explotacion);
        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        session()->put('url.intended', URL::previous());
        return view('explotacion.editarExplotacion', compact('explotacion','ganaderias'));

    }

    /**
     * Function that saves the changes of the edited Explotacion.
     *
     * Receives a POST request with the form input data, check the values and save the changes of the Explotacion.
     *
     * @param Request $request Input values in the edit Explotacion form.
     * @return \Illuminate\Http\RedirectResponse Redirects to where the user was before hitting the edit button.
     */
    public function edit(Request $request){
        $this->validate($request,[
            'codigo_explotacion'=>['required','string'],
            'municipio'=>['required','string'],
            'ganaderia_id'=>['required'],
            'explotacion_id'=>['required'],
        ]);
        $datos = $request->except(['ganaderia_id','explotacion_id']);
        $explotacion=Explotacion::find($request->input('explotacion_id'));
        $explotacion->fill($datos)->save();
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganaderia->explotaciones()->save($explotacion);
        return Redirect::intended('/');
        //return redirect()->route('verexplotacion',[$explotacion]);
    }

    /**
     * Function that deletes a specific Explotacion on our system.
     *
     * @param $id id of the Explotacion we want to delete.
     * @param Request $request POST request that could be AJAX in this case.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, Request $request){
        if($request->ajax()){

            $explotacion=Explotacion::find($id);
            $explotacion->delete();
            return $id;

        }
        return redirect()->to('/ver/explotacion');


    }
}
