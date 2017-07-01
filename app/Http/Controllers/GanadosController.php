<?php

namespace App\Http\Controllers;

use App\Asociacion;
use App\Capa;
use App\Estado;
use App\Ganaderia;
use App\Ganado;
use App\Sexo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;


/**
 * Class GanadosController.
 *
 * Controller of Ganado Model.
 *
 * @package App\Http\Controllers
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class GanadosController extends Controller
{
    /**
     * Used function for initial testing.
     *
     * @return static
     */
    public function index()
    {
        return Ganado::all()->sortBy('crotal');
    }

    /**
     * Function that returns the view to register a Ganado.
     *
     * @param integer $Ganaderia Optional: id of the Ganaderia which is owner of the Ganado.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View of the Ganado registration form.
     */
    public function registrar($Ganaderia = null)
    {

        $ganaderias = Ganaderia::all()->sortBy('select_option')->lists('select_option', 'id');
        $capas = Capa::all()->sortBy('select_option')->lists('select_option', 'id');
        $hembras = Ganado::where('sexo_id', 2)->orderBy('crotal')->get();
        $machos = Ganado::where('sexo_id', 1)->orderBy('crotal')->get();
        //$ganados = Ganado::all()->sortBy('crotal');
        $sexos = Sexo::all();
        session()->put('url.intended', URL::previous());
        if ($Ganaderia == null) {
            return view('ganado.registrarGanado', compact('ganaderias', 'sexos', 'machos', 'hembras', 'capas'));

        } else {
            return view('ganado.registrarGanado', compact('ganaderias', 'sexos', 'machos', 'hembras', 'Ganaderia', 'capas'));

        }
    }

    /**
     * Called function from a POST request in order to save a Ganado.
     *
     * It check the requests input values from the form.
     *
     * @param Request $request Input values from the form.
     * @return \Illuminate\Http\RedirectResponse Redirects to where the user was before hitting the register button.
     */
    public function guardar(Request $request)
    {
        $this->validate($request, [
            'crotal' => ['required', 'max:256','unique:ganados'],
            'sexo_id' => ['required'],
            'fecha_nacimiento' => ['required'],
            'ganaderia_id' => ['required'],
            'capa_id' => ['required'],
        ]);
        Ganado::guardarNuevo($request);
        return Redirect::intended('/');
        //return redirect()->to('/ver/ganado');
    }

    /**
     * This function shows us the view of Ganado Model.
     *
     * Depending on if we've asked for a specific Ganado or not, it will show us the details view or a listing of
     * all the elements in the Ganado model.
     * It check as well the role of the user in order to show the info it is allowed to see.
     *
     * @param integer $Ganado This parameter appears when we ask for a specific Ganado.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Returns the view of Ganado listing.
     */
    public function show($Ganado = null)
    {
        if ($Ganado == null) {

            $ganados = Ganado::ganadosUser(Auth::user());
            $descripcion = Ganado::descriptionUser(Auth::user());
            return view('ganado.verGanados', compact('ganados', 'descripcion'));
        } else {
            return $this->show_detail($Ganado);
        }
    }

    /**
     * Function that returns the view with the listing of the Ganados which status is "muertos"
     *
     * @deprecated no longer used
     * @param integer $Ganaderia
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMuertos($Ganaderia = null)
    {

        if ($Ganaderia == null) {
            $ganados = Ganado::where('estado_id', 2)->orderBy('crotal')->get();

            //dd($ganados);
            return view('ganado.verGanados', compact('ganados'));

        } else {
            // return view('ganado.registrarGanado',compact('ganaderias','sexos','Ganaderia','ganados'));

        }
    }

    /**
     * Function to show the details of a specific Ganado.
     *
     * @param integer $Ganado id of the Ganado we want to see details.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View of the details of the Ganado.
     */
    public function show_detail($Ganado)
    {
        $ganado = Ganado::find($Ganado);
        if ($ganado->hijos()!=null) {
            $ganados = $ganado->hijos();
        }
        if (null != $ganado->padre()) {
            $aux = $ganado->padre();
            $padre = $aux;

        } else {
            $padre = $ganado;
        }
        $arbol = $ganado->arbol(0, 4, "");

        return view('ganado.verGanado', compact('ganado', 'ganados', 'padre', 'arbol'));
    }

    /**
     * Function that show the edition form of an Ganado.
     *
     * @param integer $Ganado id of the Ganado we want to edit.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_edit($Ganado)
    {

        $ganadoe = Ganado::find($Ganado);
        $hembras = Ganado::where('sexo_id', 2)->orderBy('crotal')->get();
        $machos = Ganado::where('sexo_id', 1)->orderBy('crotal')->get();
        $capas = Capa::all()->sortBy('select_option')->lists('select_option', 'id');
        $sexos = Sexo::all();
        $ganaderias = Ganaderia::all()->sortBy('select_option')->lists('select_option', 'id');
        session()->put('url.intended', URL::previous());
        return view('ganado.editarGanado', compact('machos', 'hembras', 'ganadoe', 'sexos', 'ganaderias', 'capas'));


    }

    /**
     * Function that saves the changes of the edited Ganado.
     *
     * Receives a POST request with the form input data, check the values and save the changes of the Ganado.
     *
     * @param Request $request Input values in the edit Ganado form.
     * @return \Illuminate\Http\RedirectResponse Redirects to where the user was before hitting the edit button.
     */
    public function edit(Request $request)
    {
        $this->validate($request, [
            'crotal' => ['required', 'max:256'],
            'sexo_id' => ['required'],
            'fecha_nacimiento' => ['required'],
            'ganaderia_id' => ['required'],
            'capa_id' => ['required'],
            'ganado_id' => ['required'],
        ]);
        $datos = $request->except(['ganaderia_id', 'sexo_id', 'ganado_id', 'fecha_nacimiento']);
        $ganado = Ganado::find($request->input('ganado_id'));
        $padre = Ganado::find($request->input('padre_id'));
        $madre = Ganado::find($request->input('madre_id'));
        $padre->hijosP()->save($ganado);
        $madre->hijosM()->save($ganado);
        $ganado->fill($datos)->save();
        $ganado->fecha_nacimiento = $request->input('fecha_nacimiento');
        $ganado->save();
        $ganaderia = Ganaderia::find($request->input('ganaderia_id'));
        $sexo = Sexo::find($request->input('sexo_id'));
        $ganaderia->ganados()->save($ganado);
        $sexo->ganados()->save($ganado);
        $ganado->setCapa(Capa::find($request->input('capa_id')));
        return Redirect::intended('/');
        //return redirect()->route('verganado', [$ganado]);
    }

    /**
     * Function that deletes a specific Ganado on our system.
     *
     * @param integer $id id of the Ganado we want to delete.
     * @param Request $request POST request that could be AJAX in this case.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id, Request $request)
    {
        if ($request->ajax()) {

            $ganado = Ganado::find($id);
            $muerto = Estado::where('alias', 'M')->first();
            $muerto->ganados()->save($ganado);
            if (isset($ganado->gen)){

                $ganado->gen->delete();
            }
            return $id;

        }


    }
}
