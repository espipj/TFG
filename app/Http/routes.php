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
    return view('index');
});

Route::get('/inicio',[
    'uses'  =>  'InicioController@Index',
    'as'    =>  'home'
]);

Route::get('/registrar', function(){
  return view('registrar');
});
Route::group(['middleware' => 'revalidate'], function()
{
    // Grupos de rutas que tienen que revalidarse (boton atras en el navegador) RevalidateBackHistory y Kernel

    //Asociaciones
    Route::get('/registrar/asociacion', 'AsociacionesController@registrar');
    Route::post('/registrar/asociacion', 'AsociacionesController@guardar');
    Route::get('/ver/asociacion/{asociacion?}', [
        'uses'=>'AsociacionesController@show',
        'as'=>'verasociacion']);

    //Route::post('/ver/asociacion/', 'AsociacionesController@show_detail');
    Route::get('/editar/asociacion/{asociacion}', 'AsociacionesController@show_edit');
    Route::post('/editar/asociacion/completed', 'AsociacionesController@edit');
    Route::get('/eliminar/asociacion/{asociacion}', 'AsociacionesController@delete');

    //Ganaderos
    Route::get('/registrar/ganadero', 'GanaderosController@registrar');
    Route::post('/registrar/ganadero', 'GanaderosController@guardar');
    Route::get('/ver/ganadero/{ganadero?}', [
        'uses'  =>  'GanaderosController@show',
        'as'    =>  'verganadero']);
    Route::get('/editar/ganadero/{ganadero}', 'GanaderosController@show_edit');
    Route::post('/editar/ganadero/completed/', 'GanaderosController@edit');
    Route::get('/eliminar/ganadero/{ganadero}', 'GanaderosController@delete');

    //Ganaderia
    Route::get('/registrar/ganaderia/{asociacion?}', 'GanaderiasController@registrar');
    Route::post('/registrar/ganaderia', 'GanaderiasController@guardar');
    Route::get('/ver/ganaderia/{ganaderia?}', [
        'uses'  =>  'GanaderiasController@show',
        'as'    =>  'verganaderia']);
    Route::get('/editar/ganaderia/{ganaderia}', 'GanaderiasController@show_edit');
    Route::post('/editar/ganaderia/completed', 'GanaderiasController@edit');
    Route::get('/eliminar/ganaderia/{ganaderia}', 'GanaderiasController@delete');

    //Ganado
    Route::get('/registrar/ganado', 'GanadosController@registrar');
    Route::post('/registrar/ganado', 'GanadosController@guardar');
    Route::get('/ver/ganado/{ganado?}', [
        'uses'  =>  'GanadosController@show',
        'as'    =>  'verganado']);
    Route::get('/editar/ganado/{ganado}', 'GanadosController@show_edit');
    Route::post('/editar/ganado/completed', 'GanadosController@edit');
    Route::get('/eliminar/ganado/{ganado}', 'GanadosController@delete');
});



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

