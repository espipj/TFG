<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asociacion extends Model
{
    //
    /* Si queremos cambiar el nombre de la tabla en la BBDD*/
    //protected $table = 'mis_asociaciones';
    protected $fillable = ['nombre','direccion','email'];
    protected $table = 'asociaciones'; //Nombre de la tabla/migracion a la que va asociada el modelo

    public function ganaderias(){
        return $this->hasMany(Ganaderia::class);
    }

}
