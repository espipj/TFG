<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registrar', function(){
  return view('registrar');
});

Route::get('/registrar/asociacion', 'AsociacionesController@registrar');
Route::post('/registrar/asociacion', 'AsociacionesController@guardar');



Route::get('/ver/', function(){
  return view('ver');
} );

Route::get('/ver/asociacion/{asociacion?}', 'AsociacionesController@show');
