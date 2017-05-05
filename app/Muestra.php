<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    //
    protected $fillable = ['tubo'];
    protected $dates = ['fecha_extraccion'];

    public function ganado()
    {
        return $this->belongsTo(Ganado::class);
    }

    public function tipo_muestra()
    {
        return $this->belongsTo(TipoMuestra::class ,'tipo_muestra_id');
    }

    public function tipo_consulta()
    {
        return $this->belongsTo(TipoConsulta::class,'tipo_muestra_id');
    }

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class);
    }

    public function setFechaExtraccion($date)
    {
        $this->fecha_extraccion = $date;
        $this->save();
        return $this->fecha_extraccion;
    }

    public function setLaboratorio($laboratorio){
        return $laboratorio->muestras()->save($this);

    }

    public function setTipoMuestra($tipomuestra){
        return $tipomuestra->muestras()->save($this);

    }

    public function setTipoConsulta($tipoconsulta){
        return $tipoconsulta->muestras()->save($this);

    }
    public function setGanado($ganado){
        return $ganado->muestra()->save($this);

    }

    public static function guardarNueva($request){
        $datos = $request->except(['tipo_muestra_id','tipo_consulta_id','laboratorio_id','ganado_id','fecha_extraccion']);
        $muestra=self::create($datos);
        $muestra->setFechaExtraccion($request->input('fecha_extraccion'));
        $muestra->setGanado(Ganado::find($request->input('ganado_id')));
        //$muestra->setLaboratorio(Laboratorio::find($request->input('laboratorio_id')));
        $muestra->setTipoConsulta(TipoConsulta::find($request->input('tipo_consulta_id')));
        $muestra->setTipoMuestra(TipoMuestra::find($request->input('tipo_muestra_id')));
        return $muestra;

    }

}
