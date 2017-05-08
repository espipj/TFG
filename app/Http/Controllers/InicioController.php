<?php

namespace App\Http\Controllers;

use App\Asociacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{

    public function index(){
        return view('home.main');
    }

    public function land(){
        return view('index');
    }
}
