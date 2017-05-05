<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    //

    protected $fillable=['nombre','direccion','email','telefono'];

    protected function muestras(){
        return $this->hasMany(Muestra::class,'laboratorio_id');
    }


    public function getSelectOptionAttribute(){
        return $this->attributes['nombre'];
    }
}
