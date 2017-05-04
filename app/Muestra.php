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

    public function tipomuestra()
    {
        return $this->belongsTo(TipoMuestra::class);
    }

    public function tipoconsulta()
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
        return $this->fecha_nacimiento;
    }


}
