<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Asociacion
 * @package App
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class Asociacion extends Model
{
    /**
     * Array with the fillable attributes of the class.
     * @var array List of attributes of the class. Contains the name, adress, mail, and telephone.
     */
    protected $fillable = ['nombre','direccion','email','telefono'];
    /**
     * Name of the table/migration that is associated with this Model.
     * @var string
     */
    protected $table = 'asociaciones'; //Nombre de la tabla/migracion a la que va asociada el modelo

    /**
     * Definition of the relationship hasMany Ganaderia.
     *
     * We need to define Eloquent our relationships in order to work with it. An Asociacion, hasMany Ganaderia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relationship hasMany
     */
    public function ganaderias(){
        return $this->hasMany(Ganaderia::class);
    }


    /**
     * Definition of the relationship hasMany User.
     *
     * We need to define Eloquent our relationships in order to work with it. An Asociacion, hasMany Ganaderia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany hasMany
     */
    public function usuarios(){
        return $this->hasMany(User::class);
    }

    /**
     * Definition of the relationship hasManyThrough which defines that an Asociacion hasMany Ganado through a Ganaderia.
     *
     * We need to define Eloquent our relationships in order to work with it. We need to define the foreign keys of
     * Asociacion and Ganaderia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough HasManyThrough
     */
    public function ganados(){
        return $this->hasManyThrough(Ganado::class,Ganaderia::class,'asociacion_id','ganaderia_id');
    }

    /**
     * Definition of the relationship hasManyThrough which defines that an Asociacion hasMany Explotacion through a Ganaderia.
     *
     * We need to define Eloquent our relationships in order to work with it. We need to define the foreign keys of
     * Asociacion and Ganaderia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough HasManyThrough
     */
    public function explotaciones(){
        return $this->hasManyThrough(Explotacion::class,Ganaderia::class,'asociacion_id','ganaderia_id');
    }

    /**
     *Event handler triggered when deleting a Asociacion
     */
    protected static function boot() {
        parent::boot();

        static::deleting(function($asociacion) {
            $asociacion->ganaderias()->delete();
        });
    }
    /**
     * Function used to create empty Asociacion.
     *
     * If there's already an Asociacion created with that name, returns it.
     * @param string $nombre Name of the empty Asociacion we want to create.
     * @return static The Ganaderia created.
     */
    public static function AsociacionVacia($nombre){
        $asociacion=Asociacion::where('nombre',$nombre)->first();
        if(empty($asociacion)){
            $nasociacion= self::Create([
                'nombre'    =>  $nombre,
                'direccion'     =>  'No existe',
                'email'     =>  'vacia@vacia.es',
                'telefono'  =>  '000-000-000'
            ]);
            return $nasociacion;

        }else{
            return $asociacion;
        }
    }

}
