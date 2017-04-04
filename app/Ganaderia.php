<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ganaderia extends Model
{
    //
    protected $fillable = ['nombre', 'direccion'];


    public function asociacion()
    {
        return $this->belongsTo(Asociacion::class);
    }

    public function ganados()
    {
        return $this->hasMany(Ganado::class);
    }

    public function ganaderos()
    {
        return $this->hasMany(Ganadero::class);
    }
}
