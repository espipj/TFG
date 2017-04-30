<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Explotacion extends Model
{
    //
    protected $fillable=['codigo_explotacion','municipio'];

    public $timestamps=false; //Deshabilita los timestamps

    protected $table = 'explotaciones'; //Nombre de la tabla/migracion a la que va asociada el modelo

    public function ganaderia(){
        return $this->belongsTo(Ganaderia::class,'ganaderia_id');
    }
}
