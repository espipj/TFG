<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Util extends Model
{
    //

    public static function eliminarArray($array){
        foreach ($array as $elemento) {
            $elemento->delete();

        }
    }

}
