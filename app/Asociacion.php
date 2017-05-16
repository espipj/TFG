<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asociacion extends Model
{
    //
    /* Si queremos cambiar el nombre de la tabla en la BBDD*/
    //protected $table = 'mis_asociaciones';
    protected $fillable = ['nombre','direccion','email','telefono'];
    protected $table = 'asociaciones'; //Nombre de la tabla/migracion a la que va asociada el modelo

    public function ganaderias(){
        return $this->hasMany(Ganaderia::class);
    }


    public function usuarios(){
        return $this->hasMany(User::class);
    }


    public static function AsociacionVacia($nombre){
        $asociacion=Asociacion::where('nombre',$nombre)->first();
        if(empty($asociacion)){
            $nasociacion= self::Create([
                'nombre'    =>  $nombre,
                'direccion'     =>  'No existe',
                'email'     =>  'vacia@vacia.es',
                'telefono'  =>  '000-000-000'
            ]);
            return $nasociacion;

        }else{
            return $asociacion;
        }
    }

}
