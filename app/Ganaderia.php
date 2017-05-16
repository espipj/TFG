<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ganaderia extends Model
{
    //
    protected $fillable = ['nombre', 'sigla', 'email', 'telefono'];


    public function asociacion()
    {   //Se pone la clave al haber editado en Asociacion el nombre de la tabla que contiene la migración
        return $this->belongsTo(Asociacion::class, 'asociacion_id');
    }

    public function ganados()
    {
        return $this->hasMany(Ganado::class);
    }

    public function explotaciones()
    {
        return $this->hasMany(Explotacion::class);
    }

    public function ganaderos()
    {
        return $this->hasMany(Ganadero::class);
    }


    public function usuarios(){
        return $this->hasMany(User::class);
    }

    //Attribute Acessor Laravel
    public function getSelectOptionAttribute()
    {
        return $this->attributes['sigla'] . ' - ' . $this->attributes['nombre'];
    }

    public function setAsociacion($asociacion)
    {
        return $asociacion->ganaderias()->save($this);

    }

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

    public static function generateArrayForExport()
    {

        $ganaderias = Ganaderia::all();
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


    public static function guardarNuevoXLS($array)
    {
        /* array

                    'nombre' => $ganaderia->nombre,
                    'id' => $ganaderia->id,
                    'sigla' => $ganaderia->sigla,
                    'explotacion_codigo' => $explotacion->codigo_explotacion,
                    'explotacion_municipio' => $explotacion->municipio,
                    'email' => $ganaderia->email,
                    'telefono' => $ganaderia->telefono,
                    'asociacion'            => $ganaderia->asociacion->nombre,
        */

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

}
