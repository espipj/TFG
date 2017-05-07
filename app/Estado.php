<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    //
    protected $fillable=['nombre','alias'];
    public $timestamps=false;

    public function ganados(){
        return $this->hasMany(Ganado::class);
    }
}