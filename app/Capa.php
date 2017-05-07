<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capa extends Model
{
    //
    protected $fillable=['nombre','alias'];
    public $timestamps=false;

    public function ganados(){
        return $this->hasMany(Ganado::class);
    }
}
