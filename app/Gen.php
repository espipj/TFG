<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gen extends Model
{
    //
    protected $fillable=['TGLA227','BM2113','TGLA53','ETH10','SPS115','TGLA126','TGLA122','INRA23','BM1818','ETH3','ETH225','BM1824'];
    protected $table = 'genes'; //hemos cambiado el nombre por defecto de la tabla

    public function ganado(){
        return $this->belongsTo(Ganado::class);
    }
}
