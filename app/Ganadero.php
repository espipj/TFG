<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ganadero extends Model
{
    //

    protected $fillable = ['nombre','apellido1','apellido2','dni','email','telefono'];

    public function ganaderia(){
        return $this->belongsTo(Ganaderia::class);
    }
}
