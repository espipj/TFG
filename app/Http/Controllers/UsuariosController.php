<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
{
    //
    public function index(){
        return User::all()->sortBy('crotal');
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
        return redirect()->to('/ver/ganado');
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
        $usuario=Ganado::find($Usuario);
        return view('usuario.verUsuario', compact('usuario'));
    }

    public function show_edit($Usuario){

        $usuario=User::find($Usuario);
        $ganaderias=Ganaderia::all()->sortBy('select_option')->lists('select_option','id');
        return view('usuario.editarUsuario', compact('usuario','ganaderias'));



    }

    public function edit(Request $request){
        $this->validate($request,[
            'crotal'=>['required','max:256'],
            'sexo_id'=>['required'],
            'fecha_nacimiento'=>['required'],
            'ganaderia_id'=>['required'],
            'capa_id'=>['required'],
            'ganado_id'=>['required'],
        ]);
        $datos = $request->except(['ganaderia_id','sexo_id','ganado_id','fecha_nacimiento']);
        $ganado=Ganado::find($request->input('ganado_id'));
        $padre=Ganado::find($request->input('padre_id'));
        $madre=Ganado::find($request->input('madre_id'));
        $padre->hijosP()->save($ganado);
        $madre->hijosM()->save($ganado);
        $ganado->fill($datos)->save();
        $ganado->fecha_nacimiento=$request->input('fecha_nacimiento');
        $ganado->save();
        $ganaderia=Ganaderia::find($request->input('ganaderia_id'));
        $sexo=Sexo::find($request->input('sexo_id'));
        $ganaderia->ganados()->save($ganado);
        $sexo->ganados()->save($ganado);
        $ganado->setCapa(Capa::find($request->input('capa_id')));
        return redirect()->route('verganado',[$ganado]);
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
