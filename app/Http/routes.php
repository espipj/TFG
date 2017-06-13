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

Route::get('/',[
    'uses'  => 'InicioController@land',
    'as'    =>  'landing'
]);


Route::get('/registrar', function(){
  return view('registrar');
});
Route::group(['middleware' => 'revalidate'], function()
{
    // Grupos de rutas que tienen que revalidarse (boton atras en el navegador) RevalidateBackHistory y Kernel



    //Asociaciones
    Route::get('/registrar/asociacion', [
        'uses'          =>  'AsociacionesController@registrar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    Route::post('/registrar/asociacion', [
        'uses'          =>  'AsociacionesController@guardar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    Route::get('/ver/asociacion/{asociacion?}', [
        'uses'=>'AsociacionesController@show',
        'as'=>'verasociacion',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    Route::get('/editar/asociacion/{asociacion}', [
        'uses'          =>  'AsociacionesController@show_edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']
    ]);

    Route::post('/editar/asociacion/completed', [
        'uses'          =>  'AsociacionesController@edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']
    ]);

    Route::delete('/eliminar/asociacion/{asociacion}', [
        'uses'          =>  'AsociacionesController@delete',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    //Ganaderos
    Route::get('/registrar/ganadero/{ganaderia?}', [
        'uses'          =>  'GanaderosController@registrar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::post('/registrar/ganadero', [
        'uses'          =>  'GanaderosController@guardar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::get('/ver/ganadero/{ganadero?}', [
        'uses'          =>  'GanaderosController@show',
        'as'            =>  'verganadero',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::get('/editar/ganadero/{ganadero}', [
        'uses'          =>  'GanaderosController@show_edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::post('/editar/ganadero/completed/', [
        'uses'          =>  'GanaderosController@edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::delete('/eliminar/ganadero/{ganadero}', [
        'uses'          =>  'GanaderosController@delete',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    //Usuarios
    Route::get('/ver/usuario/{usuario?}', [
        'uses'          =>  'UsuariosController@show',
        'as'            =>  'verusuario',
        'middleware'    =>  'roles',
        'roles'         =>  ['SuperAdmin']]);
    Route::get('/editar/usuario/{usuario}', [
        'uses'          =>  'UsuariosController@show_edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['SuperAdmin']]);
    Route::post('/editar/usuario/completed/', [
        'uses'          =>  'UsuariosController@edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['SuperAdmin']]);
    Route::delete('/eliminar/usuario/{usuario}', [
        'uses'          =>  'UsuariosController@delete',
        'middleware'    =>  'roles',
        'roles'         =>  ['SuperAdmin']]);

    Route::post('/asignar/usuario/', [
        'uses'          =>  'UsuariosController@asignar',
        'middleware'    =>  'roles',
        'roles'         =>  ['SuperAdmin']]);

    //Ganaderia
    Route::get('/registrar/ganaderia/{asociacion?}', [
        'uses'          =>  'GanaderiasController@registrar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin','Ganadero']]);
    Route::post('/registrar/ganaderia',[
        'uses'          =>  'GanaderiasController@guardar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::get('/ver/ganaderia/{ganaderia?}', [
        'uses'          =>  'GanaderiasController@show',
        'as'            =>  'verganaderia',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin','Ganadero']]);
    Route::get('/editar/ganaderia/{ganaderia}', [
        'uses'          =>  'GanaderiasController@show_edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::post('/editar/ganaderia/completed', [
        'uses'          =>  'GanaderiasController@edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::delete('/eliminar/ganaderia/{ganaderia}',[
        'uses'          =>  'GanaderiasController@delete',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    //Ganado
    Route::get('/registrar/ganado/{ganaderia?}', [
        'uses'          =>  'GanadosController@registrar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::post('/registrar/ganado', [
        'uses'          =>  'GanadosController@guardar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::get('/ver/ganado/{ganado?}', [
        'uses'  =>  'GanadosController@show',
        'as'    =>  'verganado',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin','Ganadero']]);
    Route::get('/ver/muertos/{ganaderia?}', [
        'uses'  =>  'GanadosController@showMuertos',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::get('/editar/ganado/{ganado}', [
        'uses'          =>  'GanadosController@show_edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::post('/editar/ganado/completed', [
        'uses'          =>   'GanadosController@edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::delete('/eliminar/ganado/{ganado}', [
        'uses'          =>   'GanadosController@delete',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    //Explotacion
    Route::get('/registrar/explotacion/{explotacion?}', [
        'uses'          =>    'ExplotacionesController@registrar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::post('/registrar/explotacion', [
        'uses'          =>    'ExplotacionesController@guardar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::get('/ver/explotacion/{explotacion?}', [
        'uses'  =>  'ExplotacionesController@show',
        'as'    =>  'verexplotacion',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin','Ganadero']]);
    Route::get('/editar/explotacion/{explotacion}', [
        'uses'          =>    'ExplotacionesController@show_edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::post('/editar/explotacion/completed', [
        'uses'          =>    'ExplotacionesController@edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::delete('/eliminar/explotacion/{explotacion}', [
        'uses'          =>    'ExplotacionesController@delete',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    //Muestra
    Route::get('/registrar/muestra/{ganado?}', [
        'uses'          =>    'MuestrasController@registrar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::post('/registrar/muestra', [
        'uses'          =>    'MuestrasController@guardar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin',]]);
    Route::get('/ver/muestra/{muestra?}', [
        'uses'  =>  'MuestrasController@show',
        'as'    =>  'vermuestra',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin','Laboratorio']]);
    Route::get('/editar/muestra/{muestra}', [
        'uses'          =>    'MuestrasController@show_edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::post('/editar/muestra/completed', [
        'uses'          =>    'MuestrasController@edit',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);
    Route::delete('/eliminar/muestra/{muestra}', [
        'uses'          =>    'MuestrasController@delete',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    //Laboratorio
    Route::get('/ver/laboratorio/{laboratorio?}', [
        'uses'  =>  'LaboratorioController@show',
        'as'    =>  'verlaboratorio',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    //Importar
    Route::post('/importar/{opcion}', [
        'uses'          =>   'ImportExportController@importar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin']]);

    //Exportar
    Route::get('/exportar/{opcion}/{formato}', [
        'uses'          =>   'ImportExportController@exportar',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin','Ganadero']]);

    //Genes


    Route::get('/ver/genes', [
        'uses'  =>  'GenesController@show',
        'as'    =>  'vergen',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin','Laboratorio']]);
    Route::post('/filiar/ganado', [
        'uses'  =>  'GenesController@filiar',
        'as'    =>  'filiar',
        'middleware'    =>  'roles',
        'roles'         =>  ['SuperAdmin','Laboratorio']]);

    Route::get('/anadir/genes/{ganado}', [
        'uses'  =>  'GenesController@anadirGenes',
        'as'    =>  'anadirGenes',
        'middleware'    =>  'roles',
        'roles'         =>  ['SuperAdmin','Laboratorio']]);

    Route::post('/anadir/genes', [
        'uses'  =>  'GenesController@anadirGenesPost',
        'as'    =>  'anadirGenesPost',
        'middleware'    =>  'roles',
        'roles'         =>  ['SuperAdmin','Laboratorio']]);

    Route::get('/solicitar/filiacion/{ganado}', [
        'uses'  =>  'GenesController@solicitudFiliacion',
        'as'    =>  'solicitudFiliacion',
        'middleware'    =>  'roles',
        'roles'         =>  ['SuperAdmin','Laboratorio']]);

    //Route::get('marcador/{marcador}','GenesController@Marcador');
    //Route::get('frecuencia/{alelo}/{marcador}','GenesController@Frecuencia');
    //Route::get('filiacion','GenesController@Filiar');

    //Panel de Inicio
    Route::get('/panel',[
        'uses'          =>  'InicioController@Index',
        'as'            =>  'home',
        'middleware'    =>  'roles',
        'roles'         =>  ['Administrador','SuperAdmin','Laboratorio','Ganadero']]);
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

