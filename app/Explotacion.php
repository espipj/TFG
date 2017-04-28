<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Explotacion extends Model
{
    //
    protected $fillable=['municipio'];

    protected $table = 'explotaciones'; //Nombre de la tabla/migracion a la que va asociada el modelo

    public function asociacion(){
        return $this->belongsTo(Asociacion::class,'asociacion_id');
    }
}
