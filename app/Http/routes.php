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
    return view('layout');
});

Route::get('/inicio',[
    'uses'  =>  'InicioController@Index',
    'as'    =>  'home'
]);

Route::get('/registrar', function(){
  return view('registrar');
});
//Asociaciones
Route::get('/registrar/asociacion', 'AsociacionesController@registrar');
Route::post('/registrar/asociacion', 'AsociacionesController@guardar');
Route::get('/ver/asociacion/', 'AsociacionesController@show');
Route::post('/ver/asociacion/', 'AsociacionesController@show_detail');
Route::post('/editar/asociacion/', 'AsociacionesController@show_edit');
Route::post('/editar/asociacion/completed', 'AsociacionesController@edit');
Route::post('/eliminar/asociacion/', 'AsociacionesController@delete');

//Ganaderos
Route::get('/registrar/ganadero', 'GanaderosController@registrar');
Route::post('/registrar/ganadero', 'GanaderosController@guardar');
Route::get('/ver/ganadero/', 'GanaderosController@show');
Route::post('/ver/ganadero/', 'GanaderosController@show_detail');
Route::post('/editar/ganadero/', 'GanaderosController@show_edit');
Route::post('/editar/ganadero/completed', 'GanaderosController@edit');
Route::post('/eliminar/ganadero/', 'GanaderosController@delete');

//Ganaderia
Route::get('/registrar/ganaderia', 'GanaderiasController@registrar');
Route::post('/registrar/ganaderia', 'GanaderiasController@guardar');
Route::get('/ver/ganaderia/', 'GanaderiasController@show');
Route::post('/ver/ganaderia/', 'GanaderiasController@show_detail');
Route::post('/editar/ganaderia/', 'GanaderiasController@show_edit');
Route::post('/editar/ganaderia/completed', 'GanaderiasController@edit');
Route::post('/eliminar/ganaderia/', 'GanaderiasController@delete');

//Ganado
Route::get('/registrar/ganado', 'GanadosController@registrar');
Route::post('/registrar/ganado', 'GanadosController@guardar');
Route::get('/ver/ganado/', 'GanadosController@show');
Route::post('/ver/ganado/', 'GanadosController@show_detail');
Route::post('/editar/ganado/', 'GanadosController@show_edit');
Route::post('/editar/ganado/completed', 'GanadosController@edit');
Route::post('/eliminar/ganado/', 'GanadosController@delete');

/* Authentication routes... Utilizamos uses-as para usar action=route('as') y no tenerno que preocupar de
la url(puede que cambie en un futuro)*/
Route::get('login', [
    'uses'=>'Auth\AuthController@getLogin',
    'as'=>'login'
]);

Route::post('login', 'Auth\AuthController@postLogin');
Route::get('cerrar-sesion', [
    'uses'  =>  'Auth\AuthController@getLogout',
    'as'    =>  'logout'
]);

// Registration routes...
Route::get('registro', [
    'uses'=>'Auth\AuthController@getRegister',
    'as'=>'register'
]);
Route::post('registro', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/ver/', function(){
  return view('ver');
} );

