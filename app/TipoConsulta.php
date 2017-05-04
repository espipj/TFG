<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoConsulta extends Model
{
    //
    protected $fillable=['nombre'];

    protected function muestras(){
        return $this->hasMany(Muestra::class);
    }


    public function getSelectOptionAttribute(){
        return $this->attributes['nombre'];
    }
}
