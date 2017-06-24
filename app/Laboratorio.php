<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Laboratorio
 * @package App
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class Laboratorio extends Model
{


    /**
     * Array with the fillable attributes of the class.
     * @var array List of attributes of the class. Contains the name, adress, email, and telephone.
     */
    protected $fillable=['nombre','direccion','email','telefono'];

    /**
     * Definition of the relationship hasMany Muestra.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A Laboratorio, hasMany Muestra.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relationship hasMany
     */
    public function muestras(){
        return $this->hasMany(Muestra::class,'laboratorio_id');
    }


    /**
     * Function used to generate a string for the dropdown selectors to have both attributes displayed
     * @return string The string that is going to be shown in a select option dropdown.
     */
    public function getSelectOptionAttribute(){
        return $this->attributes['nombre'];
    }
}
