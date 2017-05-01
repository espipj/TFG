<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    //
    protected $fillable=['nombre','alias'];

    public function ganados()
    {
        return $this->hasMany(Ganado::class);
    }
}
