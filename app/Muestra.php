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

    public function tipoMuestra()
    {
        return $this->belongsTo(TipoMuestra::class);
    }

    public function tipoConsulta()
    {
        return $this->belongsTo(TipoConsulta::class);
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
        $muestra->setLaboratorio(Laboratorio::find($request->input('laboratorio_id')));
        $tconsulta=TipoConsulta::find($request->input('tipo_consulta_id'));
        $muestra->setTipoConsulta($tconsulta);
        $muestra->setTipoMuestra(TipoMuestra::find($request->input('tipo_muestra_id')));
        return $muestra;

    }

}
