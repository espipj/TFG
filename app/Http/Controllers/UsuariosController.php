<?php

namespace App\Http\Controllers;

use App\Asociacion;
use App\Ganaderia;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
{
    //
    public function index(){
        return User::all()->sortBy('name');
    }
    public function guardar(Request $request){
        $this->validate($request,[
            'crotal'=>['required','max:256'],
            'sexo_id'=>['required'],
            'fecha_nacimiento'=>['required'],
            'ganaderia_id'=>['required'],
            'capa_id'=>['required'],
        ]);
        Ganado::guardarNuevo($request);
        return redirect()->to('/ver/usuario');
    }

    public function show($Usuario=null){
        if($Usuario==null){
            $usuarios=User::all()->sortBy('name');
            return view('usuario.verUsuarios',compact('usuarios'));
        }else{
            return $this->show_detail($Usuario);
        }
    }


    public function show_detail($Usuario){
        $usuario=User::find($Usuario);
        return view('usuario.verUsuario', compact('usuario'));
    }

    public function show_edit($Usuario){

        $usuario=User::find($Usuario);
        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        $asociaciones=Asociacion::all()->sortBy('nombre')->lists('nombre','id');
        return view('usuario.editarUsuario', compact('usuario','ganaderias','asociaciones'));



    }

    public function edit(Request $request){
        $this->validate($request,[
            'usuario_id'=>['required'],
        ]);
        $user=User::find($request->input('usuario_id'));
        $user->ganaderia()->dissociate();
        $user->asociacion()->dissociate();

        if($request['asociacion_id']){
            //dd('gal');
            $user->asociacion()->associate(Asociacion::where('id',$request->input('asociacion_id'))->first());
        }

        if($request['ganaderia_id']){
            //dd('hola');
            $user->ganaderia()->associate(Ganaderia::where('id',$request->input('ganaderia_id'))->first());

        }
        $user->save();

        return redirect()->route('verusuario',[$user]);
    }

    public function delete($id,Request $request){
        if($request->ajax()){

            $ganado=Ganado::find($id);
            $muerto=Estado::where('nombre','Muerto')->first();
            $muerto->ganados()->save($ganado);
            return $id;

        }


    }

    public function asignar(Request $request){
        $user=User::where('email',$request['email'])->first();
        $user->roles()->detach();

        if ($request['role_ganad']){
            $user->roles()->attach(Role::where('name','Ganadero')->first());
        }
        if ($request['role_labo']){
            $user->roles()->attach(Role::where('name','Laboratorio')->first());
        }
        if ($request['role_admin']){
            $user->roles()->attach(Role::where('name','Administrador')->first());
        }
        return redirect()->back();
    }
}
