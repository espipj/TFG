<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ganado extends Model
{
    //
    protected $fillable=['crotal','fecha_nacimiento'];

    public function ganaderia(){
        return $this->belongsTo(Ganaderia::class);
    }
    public function sexo(){
    return $this->belongsTo(Sexo::class);
    }
}
