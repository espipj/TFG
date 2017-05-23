<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gen extends Model
{
    //
    protected $fillable=['marcadores','nombres'];
    protected $table = 'genes'; //hemos cambiado el nombre por defecto de la tabla
    protected $casts = [
        'marcadores' => 'array',
        'nombres' => 'array'
    ];
    public function ganado(){
        return $this->belongsTo(Ganado::class);
    }

    public function asignarGanado($ganado){
        return $ganado->gen()->save($this);
    }

    public function calcularProbabilidad($genP,$genM,$genH){

    }
}
