<?php

namespace App;

use App\Http\Controllers\AsociacionesController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Ganaderia
 * @package App
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class Ganaderia extends Model
{
    /**
     * Array with the fillable attributes of the class.
     * @var array List of attributes of the class. Contains the name, alias (aka sigla), email, and telephone.
     */
    protected $fillable = ['nombre', 'sigla', 'email', 'telefono'];


    /**
     * Definition of the relationship BelongsTo Asociacion.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A Ganaderia, BelongsTo Asociacion.
     * We define as well how it's going to be saved at our migration the foreign key of an Asociacion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relationship BelongsTo
     */
    public function asociacion()
    {   //Se pone la clave al haber editado en Asociacion el nombre de la tabla que contiene la migración
        return $this->belongsTo(Asociacion::class, 'asociacion_id');
    }

    /**
     * Definition of the relationship hasMany Ganado.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A Ganaderia, hasMany Ganado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relationship hasMany
     */
    public function ganados()
    {
        return $this->hasMany(Ganado::class);
    }

    /**
     * Definition of the relationship hasMany Explotacion.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A Ganaderia, hasMany Explotacion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relationship hasMany
     */
    public function explotaciones()
    {
        return $this->hasMany(Explotacion::class);
    }

    /**
     * @deprecated Deprecated by the needs of the client.
     * Definition of the relationship hasMany Ganadero.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A Ganaderia, hasMany Ganadero.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relationship hasMany
     */
    public function ganaderos()
    {
        return $this->hasMany(Ganadero::class);
    }


    /**
     * Definition of the relationship hasMany User.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A Ganaderia, hasMany User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Relationship hasMany
     */
    public function usuarios(){
        return $this->hasMany(User::class);
    }


    /**
     *Event handler triggered when deleting a Ganaderia
     */
    protected static function boot() {
        parent::boot();

        static::deleting(function($ganaderia) {
            $ganaderia->ganados()->delete();
            $ganaderia->explotaciones()->delete();
            //$ganaderia->usuarios()->delete();
        });
    }

    /**
     * Function used to generate a string for the dropdown selectors to have both attributes displayed
     * @return string The string that is going to be shown in a select option dropdown.
     */
    public function getSelectOptionAttribute()
    {
        return $this->attributes['sigla'] . ' - ' . $this->attributes['nombre'];
    }

    /**
     * Sets an Asociacion that owns this Ganaderia.
     * @param $asociacion Asociacion which owns the Ganaderia.
     * @return mixed
     */
    public function setAsociacion($asociacion)
    {
        return $asociacion->ganaderias()->save($this);

    }

    /**
     * Function used to create empty Ganaderia.
     *
     * If there's already an Ganaderia created with that name, returns it.
     * @param string $nombre Name of the empty Ganaderia we want to create.
     * @param string $sigla Alias of the Ganaderia we want to create.
     * @return static The Ganaderia created.
     */
    public static function GanaderiaVacia($nombre, $sigla)
    {
        $ganaderia = Ganaderia::where('nombre', $nombre)->first();
        if (empty($ganaderia)) {
            $nganaderia = self::Create([
                'nombre' => $nombre,
                'sigla' => $sigla,
                'email' => 'vacia@vacia.es',
                'telefono' => '000-000-000'
            ]);
            $nganaderia->setAsociacion(Asociacion::AsociacionVacia("Asociación Vacia"));
            return $nganaderia;

        } else {
            if (empty($ganaderia->asociacion)) {
                $ganaderia->setAsociacion(Asociacion::AsociacionVacia("Asociación Vacia"));
            }
            return $ganaderia;
        }
    }

    /**
     * Generates the Array of Ganaderia to export it (as XLS/CSV)
     *
     * @return array Array with every Ganaderia in the system.
     */
    public static function generateArrayForExport()
    {

        $ganaderias = Ganaderia::ganaderiasAExportar();
        $array = array();
        foreach ($ganaderias as $ganaderia) {
            $explotaciones = $ganaderia->explotaciones;
            foreach ($explotaciones as $explotacion) {


                $aux = [
                    'nombre' => $ganaderia->nombre,
                    'id' => $ganaderia->id,
                    'sigla' => $ganaderia->sigla,
                    'explotacion_codigo' => $explotacion->codigo_explotacion,
                    'explotacion_municipio' => $explotacion->municipio,
                    'email' => $ganaderia->email,
                    'telefono' => $ganaderia->telefono,
                    'asociacion' => $ganaderia->asociacion->nombre,

                ];
                array_push($array, $aux);
            }
        }
        return $array;
    }


    /**
     * Helper function for importarXLS
     * Saves a new Ganaderia with the data of an import file.
     * @param array $array The array with the data of a new Ganaderia.
     * @return Ganaderia|static The that has just been created.
     * @see Ganaderia::importarXLS()
     */
    public static function guardarNuevoXLS($array)
    {
        if (!empty($array->email) && !empty($array->telefono)) {
            $ganaderia = self::create([
                'nombre' => $array->nombre,
                'sigla' => $array->sigla,
                'email' => $array->email,
                'telefono' => $array->telefono,
            ]);

        } else {
            $ganaderia = self::GanaderiaVacia($array->nombre,$array->sigla);

        }

        if (!empty($array->asociacion)) {

            $ganaderia->setAsociacion(Asociacion::AsociacionVacia($array->asociacion));
        }
        if (!empty($array->explotacion_codigo) && !empty($array->explotacion_municipio)) {
            $ganaderia->explotaciones()->save(Explotacion::crearExplotacion($array->explotacion_codigo, $array->explotacion_municipio));
        }
        return $ganaderia;

    }


    /**
     * Helper function for importarXLS
     * Updates a Ganaderia with the data of an import
     * @param array $array The array with the data to update Ganaderia.
     * @param Ganaderia $oganaderia Ganaderia to be updated.
     * @return Ganaderia|static The Ganaderia that has just been updated.
     * @see Ganaderia::importarXLS()
     */
    private static function actualizarXLS($array, $oganaderia)
    {
        if (!empty($array->email) && !empty($array->telefono)) {
            $oganaderia->fill([
                'nombre' => $array->nombre,
                'sigla' => $array->sigla,
                'email' => $array->email,
                'telefono' => $array->telefono,
            ])->save();
        }

        if (!empty($array->asociacion)) {

            $oganaderia->setAsociacion(Asociacion::AsociacionVacia($array->asociacion));
        }
        if (!empty($array->explotacion_codigo) && !empty($array->explotacion_municipio)) {
            $oganaderia->explotaciones()->save(Explotacion::crearExplotacion($array->explotacion_codigo, $array->explotacion_municipio));
        }
        return $oganaderia;

    }

    /**
     * Main function for import of the Model Ganaderia.
     *
     * Checks if the Ganaderia already exists and if so it just updates it.
     * If not it creates a new one.
     * @uses Ganaderia::actualizarXLS()
     * @uses Ganaderia::guardarNuevoXLS()
     * @see Ganaderia::actualizarXLS()
     * @see Ganaderia::guardarNuevoXLS()
     * @param $reader
     * @return array With every Ganaderia updated or created.
     */
    public static function importarXLS($reader)
    {
        $insert = array();
        foreach ($reader->get() as $ganaderia) {
            $oganaderia = Ganaderia::where([
                'nombre' => $ganaderia->nombre,
                'sigla' => $ganaderia->sigla
            ])->first();
            if (empty($oganaderia)) {

                array_push($insert, self::guardarNuevoXLS($ganaderia));

            } else {

                array_push($insert, self::actualizarXLS($ganaderia, $oganaderia));

            }
        }

        return $insert;
    }

    /**
     * @param $user
     * @return string|static
     */
    public static function ganaderiasUser($user)
    {
        $ganaderias = Ganaderia::all()->sortBy('nombre');
        if ($user->hasAnyRole(array('SuperAdmin'))) {
            return $ganaderias;


        } else if ($user->hasAnyRole(array('Administrador'))) {

            if ($user->asociacion != null) {

                $asociacion = Asociacion::find($user->asociacion->id);

                return $ganaderias = $asociacion->ganaderias->sortBy('nombre');
            } else {

                return $ganaderias = "sinpermiso";
            }


        } else {
            return $ganaderias = "sinpermiso";
        }
    }

    /**
     * Returns Ganado that must be exported with a determined User.
     *
     * @return Ganaderia|\Illuminate\Support\Collection|string
     */
    public static function ganaderiasAExportar()
    {


        $ganaderias = Ganaderia::ganaderiasUser(Auth::user());

        if ($ganaderias == "sinpermiso") {
            return $ganaderias = collect(new Ganado);
        } else {
            return $ganaderias;
        }

    }

}
