<?php

namespace App\Http\Controllers;

use App\Asociacion;
use App\Explotacion;
use App\Ganaderia;
use App\Ganado;
use App\Util;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

/**
 * Class AsociacionesController.
 *
 * Controller class for Model Ganaderia.
 * @package App\Http\Controllers
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class GanaderiasController extends Controller
{
    /**
     * Used function for initial testing.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[] Returns an array with a every element of Explotaciones.
     *
     *
     */
    public function index(){
        return Ganaderia::all();
    }

    /**
     * Function that returns the view to register an Ganaderia.
     *
     * @param integer $Asociacion Optional: id of the Asociacion which is owner of the Ganaderia.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View of the Ganaderia registration form.
     */
    public function registrar($Asociacion = null){
        session()->put('url.intended', URL::previous());
        if($Asociacion==null){

            $asociaciones= Asociacion::lists('nombre','id');
            return view('ganaderia.registrarGanaderia',compact('asociaciones'));

        }else{

            $asociaciones= Asociacion::lists('nombre','id');
            return view('ganaderia.registrarGanaderia',compact('asociaciones','Asociacion'));
        }
    }

    /**
     * Called function from a POST request in order to save an Ganaderia.
     *
     * It check the requests input values from the form.
     *
     * @param Request $request Input values from the form.
     * @return \Illuminate\Http\RedirectResponse Redirects to where the user was before hitting the register button.
     */
    public function guardar(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:256'],
            'sigla'=>['required'],
            'email'=>['required','email'],
            'telefono'=>['required'],
            'asociacion_id'=>['required']
        ]);
        $datos = $request->except('asociacion_id');
        $ganaderia=Ganaderia::create($datos);
        $asociacion=Asociacion::find($request->input('asociacion_id'));
        $asociacion->ganaderias()->save($ganaderia);
        return Redirect::intended('/');
        //return redirect()->route('verganaderia',[$ganaderia]);
    }

    /**
     * This function shows us the view of Ganaderia Model.
     *
     * Depending on if we've asked for a specific Ganaderia or not, it will show us the details view or a listing of
     * all the elements in the Ganaderia model.
     * It check as well the role of the user in order to show the info it is allowed to see.
     *
     * @param integer $Ganaderia This parameter appears when we ask for a specific Ganaderia.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Returns the view of Ganaderia listing.
     */
    public function show($Ganaderia=null){
        $usuario=Auth::user();
        if ($usuario->ganaderia!=null){

            $Ganaderia=$usuario->ganaderia->id;
        }
        if($Ganaderia==null){

            $ganaderias=Ganaderia::ganaderiasUser($usuario);
            return view('ganaderia.verGanaderias',compact('ganaderias'));
        }else{
            return $this->show_detail($Ganaderia);
        }
    }

    /**
     * Function to show the details of a specific Ganaderia.
     *
     * @param integer $Ganaderia id of the Ganaderia we want to see details.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View of the details of the Ganaderia.
     */
    public function show_detail($Ganaderia){
        $ganaderia=Ganaderia::find($Ganaderia);
        $ganados=$ganaderia->ganados->sortBy('crotal')->sortByDesc('vivo');
        $ganaderos=$ganaderia->ganaderos;
        $explotaciones=$ganaderia->explotaciones;
        return view('ganaderia.verGanaderia', compact('ganaderia','ganados','ganaderos','explotaciones'));

    }

    /**
     * Function that show the edition form of an Ganaderia.
     *
     * @param integer $Ganaderia id of the Ganaderia we want to edit.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_edit($Ganaderia){

        $ganaderia=Ganaderia::find($Ganaderia);
        $asociaciones= Asociacion::lists('nombre','id');
        session()->put('url.intended', URL::previous());
        return view('ganaderia.editarGanaderia', compact('ganaderia','asociaciones'));

    }

    /**
     * Function that saves the changes of the edited Ganaderia.
     *
     * Receives a POST request with the form input data, check the values and save the changes of the Ganaderia.
     *
     * @param Request $request Input values in the edit Ganaderia form.
     * @return \Illuminate\Http\RedirectResponse Redirects to where the user was before hitting the edit button.
     */
    public function edit(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:256'],
            'sigla'=>['required'],
            'email'=>['required'],
            'telefono'=>['required'],
            'asociacion_id'=>['required'],
            'ganaderia_id' =>['required'],
        ]);
        $datos = $request->except('asociacion_id','ganaderia_id');
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $ganaderia->fill($datos)->save();
        $asociacion=Asociacion::find($request->input('asociacion_id'));
        $asociacion->ganaderias()->save($ganaderia);
        return Redirect::intended('/');
        //return redirect()->route('verganaderia',[$ganaderia]);
        //return redirect()->to('/ver/ganaderia');
    }

    /**
     * Function that deletes a specific Ganaderia on our system.
     *
     * @param integer $id id of the Ganaderia we want to delete.
     * @param Request $request POST request that could be AJAX in this case.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, Request $request){

        if($request->ajax()){

            $ganaderia=Ganaderia::find($id);
            Util::eliminarArray($ganaderia->ganados);
            Util::eliminarArray($ganaderia->explotaciones);
            $ganaderia->delete();
            return $id;

        }
        return redirect()->to('/ver/ganaderia');

    }
}
