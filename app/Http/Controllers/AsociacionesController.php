<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Asociacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Clase AsociacionesController.
 *
 * Es la clase controladora asociada al modelo Asociacion.
 * @package App\Http\Controllers
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class AsociacionesController extends Controller
{

    /**
     * Funcion utilizada para el testeo inicial de la aplicación.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[] Devuelve un array con el listado de todas las Asociaciones.
     *
     *
     */
    public function index(){

      $asociaciones=Asociacion::all();
      return $asociaciones;

    }

    /**
     * Funcion que nos devuelve la vista para registrar una asociación.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Vista donde podemos registrar una asociación.
     *
     */
    public function registrar(){
        session()->put('url.intended', URL::previous());
        return view('asociacion.registrarAsociacion');
    }

    /**
     * Funcion llamada desde una solicitud POST para guardar una asociación.
     *
     * Se comprueban los valores de entrada del formulario.
     *
     * @param Request $request los valores introducidos en el formulario de registro.
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
     * Funcion que nos muestra la vista del Modelo Asociacion.
     *
     * Dependiendo de si hemos solicitado una asociación en concreto o no, nos mostrará la interfaz de detalle o
     * nos enseñara el listado de todas las asociaciones.
     *
     * @param null $Asociacion Parametro que puede aparecer si se solicita una asociación en concreto.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Retorna la vista del listado de asociaciones.
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
     * Función para mostrar los detalles de una asociación en concreto.
     *
     * @param $Asociacion El id de la asociación que queremos ver detalles.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View La vista de detalles de la asociación.
     */
    public function show_detail($Asociacion){

    $asociacion=Asociacion::find($Asociacion);
    $ganaderias=$asociacion->ganaderias;
    return view('asociacion.verAsociacion', compact('asociacion','ganaderias'));

    }

    /**
     * Función que muestra el formulario de edición de una asociación.
     *
     * @param $Asociacion El id de la asociación que queremos editar
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View La bista de edición de asociación.
     */
    public function show_edit($Asociacion){

        $asociacion=Asociacion::find($Asociacion);
        session()->put('url.intended', URL::previous());
        return view('asociacion.editarAsociacion', compact('asociacion'));

    }

    /**
     * Función que guarda los datos de la asociación editada.
     *
     * Recoge una solicitud POST, comprueba los valores y realiza la edicion de la asociación.
     *
     * @param Request $request Los valores introducidos en el formulario de edición.
     * @return \Illuminate\Http\RedirectResponse Redirige a donde estaba el usuario antes de solicitar la edición.
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
     * Función utilizada para eliminar una Asociación de nuestro sistema.
     *
     * @param $id El id de la asociación a eliminar.
     * @param Request $request La petición POST que en este caso es posible que sea AJAX.
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
