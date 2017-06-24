<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Explotacion
 * @package App
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class Explotacion extends Model
{

    /**
     * Array with the fillable attributes of the class.
     * @var array List of attributes of the class. Contains the code of the Explotacion and the town where it's located at.
     */
    protected $fillable=['codigo_explotacion','municipio'];

    /**
     * Used to disable timestamps at table database.
     * @var bool
     */
    public $timestamps=false; //Deshabilita los timestamps

    /**
     * Name of the table/migration that is associated with this Model.
     * @var string
     */
    protected $table = 'explotaciones'; //Nombre de la tabla/migracion a la que va asociada el modelo

    /**
     * Definition of the relationship BelongsTo Ganaderia.
     *
     * We need to define Eloquent our relationships in order to work with it. An Explotacion, BelongsTo Ganaderia.
     * We define as well how it's going to be saved at our migration the foreign key of a Ganaderia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relationship BelongsTo
     */
    public function ganaderia(){
        return $this->belongsTo(Ganaderia::class,'ganaderia_id');
    }


    /**
     * Constructor for an Explotacion
     *
     * Checks if the Explotacion with that data is already created and returns it. If the Explotacion
     * is not created, it creates it.
     * @param string $codigo Code of the Explotacion
     * @param string $municipio Town of the Explotacion
     * @return static Explotacion
     */
    public static function crearExplotacion($codigo, $municipio){
        $explotacion=Explotacion::where([
            'codigo_explotacion'    =>  $codigo,
            'municipio'             =>  $municipio
        ])->first();
        if(!empty($explotacion)){
            return  $explotacion;
        }else{
            return self::create([
                'codigo_explotacion'    =>  $codigo,
                'municipio'             =>  $municipio
            ]);
        }
    }
}
