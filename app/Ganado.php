<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ganado extends Model
{
    //Capa Morucha Cárdena Morucha Negra
    protected $fillable=['crotal','fecha_nacimiento','capa'];

    public function ganaderia(){
        return $this->belongsTo(Ganaderia::class);
    }
    public function sexo(){
    return $this->belongsTo(Sexo::class);
    }

    public function madre(){
        return $this->belongsTo(Ganado::class,'madre_id');
    }

    public function padre()
    {
        return $this->belongsTo(Ganado::class, 'padre_id');
    }
}
