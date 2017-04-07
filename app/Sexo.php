<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    //
    protected $fillable=['nombre'];

    public function ganados()
    {
        return $this->hasMany(Ganado::class);
    }
}
