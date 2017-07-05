<?php

namespace App\Http\Controllers;

use App\Asociacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class InicioController.
 *
 * Basic class just to show the home and the landing page.
 *
 * @author Pablo Espinosa <espipj@gmail.com>
 * @package App\Http\Controllers
 */
class InicioController extends Controller
{


    /**
     * Shows the home view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('home.main');
    }

    /**
     * Shows the landing view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function land(){
        return view('index');
    }

    public function manual(){
        $file=public_path().'/docs/manual.pdf';
        return response()->download($file, "ManualDeUsuario.pdf");
    }

    public function infoxls(){
        return view('home.ayudaxls');
    }

}
