<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Util
 *
 * Helper class
 *
 * @package App
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class Util extends Model
{
    /**
     * Deletes every element of an array.
     * @param array $array
     */
    public static function eliminarArray($array){
        foreach ($array as $elemento) {
            $elemento->delete();

        }
    }

}
