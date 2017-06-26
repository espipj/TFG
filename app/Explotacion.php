<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


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
    protected $table = 'explotaciones';


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
     * This function return us the array of Ganado that a User must see or can export.
     * @param User $user The user that is requesting the resource.
     * @return array|string Ganado the user can see or use.
     */
    public static function explotacionesUser($user){
        if ($user->hasAnyRole(array('SuperAdmin'))) {
            return $explotaciones=Explotacion::all();


        } else if ($user->hasAnyRole(array('Administrador'))) {

            if ($user->asociacion != null) {

                $asociacion = $user->asociacion;

                $explotaciones = $asociacion->explotaciones;
                return $explotaciones;
            }else{

                return $explotaciones="noexp";
            }



        }else if ($user->hasAnyRole(array('Ganadero'))){
            if ($user->ganaderia != null) {

                $explotaciones=$user->ganaderia->explotaciones;
            }else{
                $explotaciones="noexp";

            }
            return $explotaciones;
        }else{
            return $explotaciones="noexp";
        }
    }

    /**
     * This function return us the description for the view of Explotacion that a User must see.
     * @param User $user The user that is requesting the resource.
     * @return string A description.
     */
    public static function descriptionUser($user){

        $descripcion="Desde esta página puedes registrar una nueva explotacion o editar las ya existentes y listadas, ver sus detalles o incluso exportarlas.";
        if ($user->hasAnyRole(array('SuperAdmin'))) {
            return $descripcion;


        } else if ($user->hasAnyRole(array('Administrador'))) {
            return $descripcion;

        }else if ($user->hasAnyRole(array('Ganadero'))){
            return $descripcion="Desde esta página puedes ver las explotaciones que pertenecen a tu ganadería, sus detalles y exportarlos a tu ordenador";

        }else{
            return $descripcion="No tienes permiso.";
        }
    }

    /**
     * Decides the Explotacion collection it should export, depending on permissions/roles.
     *
     * @return \Illuminate\Support\Collection
     * @see Ganado::generateArrayForExport()
     * @see Ganado::ganadosUser()
     * @uses Ganado::ganadosUser()
     *
     */
    public static function explotacionAExportar(){


        $explotaciones=Explotacion::explotacionesUser(Auth::user());

        if($explotaciones=="noexp"){
            return $explotaciones=collect(new Explotacion);
        }else{
            return $explotaciones;
        }

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


    /**
     * Main function for import of the Model Explotacion
     *
     * Checks if the Explotacion already exists and if so it just updates it.
     * If not it creates a new one.
     *
     * @uses Explotacion::actualizarXLS()
     * @uses Explotacion::guardarNuevoXLS()
     * @param $reader
     * @return array With every Explotacion updated or created.
     */
    public static function importarXLS($reader)
    {
        $insert=array();

        //dd($reader->get());
        foreach ($reader->get() as $explotacion) {
            $oexplotacion=Explotacion::where('codigo_explotacion',$explotacion->codigo_explotacion)->first();
            if(empty($oexplotacion)){

                array_push($insert,self::guardarNuevoXLS($explotacion));

            }else{

                array_push($insert,self::actualizarXLS($explotacion,$oexplotacion));

            }
        }

        return $insert;

    }

    /**
     * Generates the Array of Explotacion to export it (as XLS/CSV)
     *
     * @return array Array with every Explotacion in the system.
     */
    public static function generateArrayForExport()
    {
        $explotaciones=Explotacion::explotacionAExportar();
        $array=array();
        foreach ($explotaciones as $explotacion){
            if (empty($explotacion->codigo_explotacion)){
                $codigo="no definido";
            }else{
                $codigo=$explotacion->codigo_explotacion;
            }
            if (empty($explotacion->municipio)){
                $municipio="no definido";
            }else{
                $municipio=$explotacion->municipio;
            }
            if (empty($explotacion->ganaderia->nombre)){
                $ganaderia="no definido";
            }else{
                $ganaderia=$explotacion->ganaderia->nombre;
            }
            $aux=[
                'codigo_explotacion'   =>  $codigo,
                'municipio'                =>  $municipio,
                'ganaderia'                 =>  $ganaderia,

            ];

            array_push($array,$aux);
        }
        return $array;
    }


    private static function guardarNuevoXLS($explotacion)
    {
        if(isset($explotacion->codigo_explotacion)) $codigo=$explotacion->codigo_explotacion;
        if(isset($explotacion->municipio)) $municipio=$explotacion->municipio;
        $nexplotacion=New Explotacion([
            'codigo_explotacion'    => $codigo,
            'municipio'             => $municipio,
        ]);
        $nexplotacion->save();
        //dd($explotacion->ganaderia);
        if(isset($explotacion->ganaderia)){
            $ganaderia=Ganaderia::where('nombre',$explotacion->ganaderia)->first();

            $ganaderia->explotaciones()->save($nexplotacion);
        }
        //dd($nexplotacion);
        return $nexplotacion;
    }

    private static function actualizarXLS($explotacion, $oexplotacion)
    {
        if(isset($explotacion->codigo_explotacion)) $oexplotacion->codigo_explotacion=$explotacion->codigo_explotacion;
        if(isset($explotacion->municipio)) $oexplotacion->municipio=$explotacion->municipio;
        //dd($explotacion->ganaderia);
        $oexplotacion->save();
        if(isset($explotacion->ganaderia)){
            $ganaderia=Ganaderia::where('nombre',$explotacion->ganaderia)->first();

            $ganaderia->explotaciones()->save($oexplotacion);
        }

        return $oexplotacion;
    }


}
