<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ganaderia extends Model
{
    //
    protected $fillable = ['nombre', 'sigla','email','telefono'];


    public function asociacion()
    {   //Se pone la clave al haber editado en Asociacion el nombre de la tabla que contiene la migración
        return $this->belongsTo(Asociacion::class,'asociacion_id');
    }

    public function ganados()
    {
        return $this->hasMany(Ganado::class);
    }

    public function explotaciones()
    {
        return $this->hasMany(Explotacion::class);
    }

    public function ganaderos()
    {
        return $this->hasMany(Ganadero::class);
    }
}
