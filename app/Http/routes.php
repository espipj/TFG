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
//Asociaciones
Route::get('/registrar/asociacion', 'AsociacionesController@registrar');
Route::post('/registrar/asociacion', 'AsociacionesController@guardar');
Route::get('/ver/asociacion/{asociacion?}', 'AsociacionesController@show');

//Ganaderos
Route::get('/registrar/ganadero', 'GanaderosController@registrar');
Route::post('/registrar/ganadero', 'GanaderosController@guardar');
Route::get('/ver/ganadero/{ganadero?}', 'GanaderosController@show');

//Ganaderia
Route::get('/registrar/ganaderia', 'GanaderiasController@registrar');
Route::post('/registrar/ganaderia', 'GanaderiasController@guardar');
Route::get('/ver/ganaderia/{ganaderia?}', 'GanaderiasController@show');

//Ganado
Route::get('/registrar/ganado', 'GanadosController@registrar');
Route::post('/registrar/ganado', 'GanadosController@guardar');
Route::get('/ver/ganado/', 'GanadosController@show');
Route::post('/ver/ganado/', 'GanadosController@show_detail');
Route::post('/editar/ganado/', 'GanadosController@show_edit');
Route::post('/editar/ganado/completed', 'GanadosController@edit');
Route::post('/eliminar/ganado/', 'GanadosController@delete');



Route::get('/ver/', function(){
  return view('ver');
} );

