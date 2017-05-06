<?php

namespace App;


use App\Ganaderia;
use App\Ganado;
use App\Sexo;
use Illuminate\Database\Eloquent\Model;

class Ganado extends Model
{
    //Capa Morucha Cárdena Morucha Negra
    protected $fillable=['crotal','capa','vivo'];
    protected $dates=['fecha_nacimiento'];

    public function ganaderia(){
        return $this->belongsTo(Ganaderia::class);
    }
    public function sexo(){
    return $this->belongsTo(Sexo::class);
    }

    public function madre(){
        return $this->belongsTo(Ganado::class,'madre_id');
    }

    public function hijosM(){
        return $this->hasMany(Ganado::class, 'madre_id');
    }

    public function padre()
    {
        return $this->belongsTo(Ganado::class, 'padre_id');
    }

    public function hijosP(){
        return $this->hasMany(Ganado::class, 'padre_id');
    }

    public function muestra(){
        return $this->hasOne(Muestra::class);
    }


    public function setHijoP($hijo){
        return $this->hijosP()->save($hijo);

    }

    public function setHijoM($hijo){
        return $this->hijosM()->save($hijo);

    }

    public function setFechaNacimiento($date){
        $this->fecha_nacimiento=$date;

        $this->save();
        return $this->fecha_nacimiento;
    }

    public function setSexo($sexo){

        return $sexo->ganados()->save($this);
    }

    public function setGanaderia($ganaderia){
        return $ganaderia->ganados()->save($this);

    }

    public static function guardarNuevo($request){
        $datos = $request->except(['ganaderia_id','sexo_id','fecha_nacimiento']);
        $ganado=self::create($datos);
        $padre=Ganado::find($request->input('padre_id'));
        $madre=Ganado::find($request->input('madre_id'));
        $padre->setHijoP($ganado);
        $madre->setHijoM($ganado);
        $ganado->setSexo(Sexo::find($request->input('sexo_id')));
        $ganado->setGanaderia(Ganaderia::find($request->input('ganaderia_id')));
        $ganado->setFechaNacimiento($request->input('fecha_nacimiento'));
        return $ganado;

    }

    public static function generateArrayForExport(){
        $ganados=Ganado::all();
        $array=array();
        foreach ($ganados as $ganado){
            $aux=[
                'fecha de nacimiento'   =>  $ganado->fecha_nacimiento->format('d/m/Y'),
                'crotal'                =>  $ganado->crotal,
                'padre'                 =>  $ganado->padre->crotal,
                'madre'                 =>  $ganado->madre->crotal,
                'capa'                  =>  $ganado->capa,
                'sexo'                  =>  $ganado->sexo->alias,
                'vivo'                  =>  $ganado->vivo,

            ];
            array_push($array,$aux);
        }
        return $array;
    }
}
