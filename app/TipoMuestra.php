<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoMuestra
 * Simple class just to make an enumeration.
 * @package App
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class TipoMuestra extends Model
{
    /**
     * Array with the fillable attributes of the class.
     * @var array List of attributes of the class. Contains the name.
     */
    protected $fillable=['nombre'];
    /**
     * Used to disable timestamps at table database.
     * @var bool
     */
    public $timestamps=false;

    /**
     * Definition of the relationship hasMany Muestra.
     *
     * We need to define Eloquent our relationships in order to work with it. A TipoMuestra, hasMany Muestra.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relationship hasMany
     */
    public function muestras(){
        return $this->hasMany(Muestra::class);
    }

    /**
     * Function used to generate a string for the dropdown selectors to have both attributes displayed
     * @return string The string that is going to be shown in a select dropdown.
     */
    public function getSelectOptionAttribute(){
        return $this->attributes['nombre'];
    }
}
