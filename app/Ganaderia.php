<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ganaderia extends Model
{
    //
    protected $fillable = ['nombre', 'sigla','email','telefono'];



    public function asociacion()
    {   //Se pone la clave al haber editado en Asociacion el nombre de la tabla que contiene la migración
        return $this->belongsTo(Asociacion::class,'asociacion_id');
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

    //Attribute Acessor Laravel
    public function getSelectOptionAttribute(){
        return $this->attributes['sigla'].' - '.$this->attributes['nombre'];
    }

    public static function GanaderiaVacia(){
        $ganaderia=Ganaderia::where('nombre','Ganadería Vacia')->first();
        if(empty($ganaderia)){
            $nganaderia= self::Create([
                'nombre'    =>  'Ganadería Vacia',
                'sigla'     =>  'VACI',
                'email'     =>  'vacia@vacia.es',
                'telefono'  =>  '000-000-000'
            ]);
            return $nganaderia;

        }else{
            return $ganaderia;
        }
    }
    public static function generateArrayForExport()
    {

        $ganaderias=Ganaderia::all();
        $array=array();
        foreach ($ganaderias as $ganaderia){
            $explotaciones=$ganaderia->explotaciones;
            foreach ($explotaciones as $explotacion) {


                $aux = [
                    'nombre' => $ganaderia->nombre,
                    'id' => $ganaderia->id,
                    'sigla' => $ganaderia->sigla,
                    'email' => $ganaderia->email,
                    'explotacion codigo' => $explotacion->codigo_explotacion,
                    'explotacion municipio' => $explotacion->municipio,
                    'asociacion'            => $ganaderia->asociacion->nombre,

                ];
                array_push($array, $aux);
            }
        }
        return $array;
    }

}
