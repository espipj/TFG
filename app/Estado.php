<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estado
 * Simple class just to make an enumeration.
 * @package App
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class Estado extends Model
{

    /**
     * Array with the fillable attributes of the class.
     * @var array List of attributes of the class. Contains the name and an alias.
     */
    protected $fillable=['nombre','alias'];
    /**
     * Used to disable timestamps at table database.
     * @var bool
     */
    public $timestamps=false;

    /**
     * Definition of the relationship hasMany Ganado.
     *
     * We need to define Eloquent our relationships in order to work with it. An Estado, hasMany Ganado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relationship hasMany
     */
    public function ganados(){
        return $this->hasMany(Ganado::class);
    }
}
