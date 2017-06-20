<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Asociacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class AsociacionesController.
 *
 * Controller class for Model Asociacion.
 * @package App\Http\Controllers
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class AsociacionesController extends Controller
{

    /**
     * Used function for initial testing.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[] Returns an array with a every element of Asociaciones.
     *
     *
     */
    public function index(){

      $asociaciones=Asociacion::all();
      return $asociaciones;

    }

    /**
     * Function that returns the view to register an Asociacion.     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View The view where we can register an Asociacion.
     *
     */
    public function registrar(){
        session()->put('url.intended', URL::previous());
        return view('asociacion.registrarAsociacion');
    }

    /**
     * Called function from a POST request in order to save an Asociacion.
     *
     * It check the requests input values from the form.
     *
     * @param Request $request Input values from the form.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function guardar(Request $request){
      $this->validate($request,[
        'nombre'=>['required','max:100'],
        'direccion'=>['required'],
        'email'=>['required'],
        'telefono'=>['required'],
      ]);
      $datos = $request->all();
      Asociacion::create($datos);
      return Redirect::intended('/');
    }

    /**
     * This function shows us the view of Asociacion Model.
     *
     * Depending on if we've asked for a specific Asociacion or not, it will show us the details view or a listing of
     * all the elements in the Asociacion model.
     *
     * @param null $Asociacion This parameter appears when we ask for a specific Asociacion.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Returns the view of Asociacion listing.
     */
    public function show($Asociacion=null){
        $usuario=Auth::user();
        if ($usuario->asociacion!=null){

            $Asociacion=$usuario->asociacion->id;
            //dd($Asociacion);
        }
        if($Asociacion==null){

            $asociaciones=Asociacion::all();
            return view('asociacion.verAsociaciones',compact('asociaciones'));

        }else{
            return $this->show_detail($Asociacion);
        }

    }

    /**
     * Function to show the details of a specific Asociacion.
     *
     * @param $Asociacion id of the Asociacion we want to see details.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View of the details of the Asociacion.
     */
    public function show_detail($Asociacion){

    $asociacion=Asociacion::find($Asociacion);
    $ganaderias=$asociacion->ganaderias;
    return view('asociacion.verAsociacion', compact('asociacion','ganaderias'));

    }

    /**
     * Function that show the edition form of an Asociacion.
     *
     * @param $Asociacion id of the Asociacion we want to edit.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View of edition of an Asociacion.
     */
    public function show_edit($Asociacion){

        $asociacion=Asociacion::find($Asociacion);
        session()->put('url.intended', URL::previous());
        return view('asociacion.editarAsociacion', compact('asociacion'));

    }

    /**
     * Function that saves the changes of the edited Asociacion.
     *
     * Receives a POST request with the form input data, check the values and save the changes of the Asociacion.
     *
     * @param Request $request Input values in the edit Asociacion form.
     * @return \Illuminate\Http\RedirectResponse Redirects to where the user was before hitting the edit button.
     */
    public function edit(Request $request){
        $this->validate($request,[
            'nombre'=>['required','max:100'],
            'direccion'=>['required'],
            'email'=>['required'],
            'asociacion_id'=>['required'],
            'telefono'=>['required'],
        ]);
        $datos = $request->except(['asociacion_id']);
        $asociacion_id=$request->input('asociacion_id');
        $asociacion=Asociacion::find($asociacion_id);
        $asociacion->fill($datos)->save();

        return Redirect::intended('/');
        //return redirect()->route('verasociacion',[$asociacion]);
        //return redirect('ver/asociacion/'.$asociacion_id);
    }

    /**
     * Function that deletes a specific Asociacion on our system.
     *
     * @param $id id of the Asociacion we want to delete.
     * @param Request $request POST request that could be AJAX in this case.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, Request $request){

        if($request->ajax()){
            $asociacion=Asociacion::find($id);
            $asociacion->delete();
            return $id;

        }
        return redirect()->to('/ver/asociacion/');

    }
}
