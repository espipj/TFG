<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ganadero
 * @deprecated This class is deprecated by the needs of the client.
 * @package App
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class Ganadero extends Model
{
    /**
     * Array with the fillable attributes of the class.
     * @var array List of attributes of the class. Contains the name, first and second surname, ID, email, and telephone.
     */
    protected $fillable = ['nombre','apellido1','apellido2','dni','email','telefono'];

    /**
     * Belongs to a Ganaderia.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ganaderia(){
        return $this->belongsTo(Ganaderia::class);
    }
}
