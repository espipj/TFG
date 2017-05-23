<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gen extends Model
{
    //
    protected $fillable=['TGLA227','BM2113','TGLA53','ETH10','SPS115','TGLA126','TGLA122','INRA23','BM1818','ETH3','ETH225','BM1824'];
    protected $table = 'genes'; //hemos cambiado el nombre por defecto de la tabla
    protected $casts = [
        'TGLA227' => 'array',
        'BM2113' => 'array',
        'TGLA53' => 'array',
        'ETH10' => 'array',
        'SPS115' => 'array',
        'TGLA126' => 'array',
        'TGLA122' => 'array',
        'INRA23' => 'array',
        'BM1818' => 'array',
        'ETH3' => 'array',
        'ETH225' => 'array',
        'BM1824' => 'array',
    ];
    public function ganado(){
        return $this->belongsTo(Ganado::class);
    }
}
