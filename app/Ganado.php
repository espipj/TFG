<?php

namespace App;


use App\Ganaderia;
use App\Ganado;
use App\Sexo;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ganado extends Model
{
    //Capa Morucha Cárdena Morucha Negra
    protected $fillable=['crotal'];
    protected $dates=['fecha_nacimiento'];



    public function ganaderia(){
        return $this->belongsTo(Ganaderia::class);
    }
    public function sexo(){
    return $this->belongsTo(Sexo::class);
    }

    public function estado(){
        return  $this->belongsTo(Estado::class);
    }

    public function capa(){
        return  $this->belongsTo(Capa::class);
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

    public function gen(){
        return $this->hasOne(Gen::class);
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

    public function setCapa($capa){
        return $capa->ganados()->save($this);
    }

    public function setEstado($estado){
        return $estado->ganados()->save($this);
    }

    public function hijos(){
        if($this->sexo->nombre=='Macho'){
            $ganados=$this->hijosP;
        }else{
            $ganados=$this->hijosM;

        }
        return $ganados;

    }

    public function arbol($h,$p,$s){
        if($h==0 || $h==2 || $h==4){

            $s.="<ul>";

        }
        $s.="<li><a href='". route('verganado',[$this])."'>". $this->crotal ."</a>";

        if($p>0) {
            if (null!=$this->hijos()) {
                $hijos=$this->hijos();
                $length=count($hijos);
                //$s.=$p;
                //$last_key = end(array_keys($hijos));
                foreach ($hijos as $key => $hijo) {
                    if ($length==($key+1) && $key == 0) {
                        $s.=$hijo->arbol(4, --$p,"");
                    }else if ($key == 0){
                        //ultimo elemento
                        $s.=$hijo->arbol(2, --$p,"");

                    }else if($length==($key+1)){
                        $s.=$hijo->arbol(3, --$p,"");

                    }else{

                        $s.=$hijo->arbol(1, --$p,"");
                    }


                }
            }

                $s .= "</li>";

        }
        if($h==0 || $h==3 || $h==4){
           $s.="</ul>";
        }

        return $s;
    }
    public static function guardarNuevo($request){
        $datos = $request->except(['ganaderia_id','sexo_id','fecha_nacimiento','capa_id']);
        $ganado=self::create($datos);
        if(null!=$request->input('padre_id')){
            $padre=Ganado::find($request->input('padre_id'));
            $padre->setHijoP($ganado);

        }
        if(null!=$request->input('madre_id')) {
            $madre = Ganado::find($request->input('madre_id'));
            $madre->setHijoM($ganado);
        }
        $ganado->setSexo(Sexo::find($request->input('sexo_id')));
        $ganado->setCapa(Capa::find($request->input('capa_id')));
        $ganado->setGanaderia(Ganaderia::find($request->input('ganaderia_id')));
        $ganado->setFechaNacimiento($request->input('fecha_nacimiento'));
        return $ganado;

    }

    public static function guardarNuevoXLS($array){
        /* array

      "fecha_de_nacimiento" => "16/11/2006"
      "crotal" => "6828"
      "padre" => "9466"
      "madre" => "4126"
      "capa" => "N"
      "sexo" => "M"
      "estado" => "Vivo"
        */

        $ganado=self::create([
            'crotal'    =>  $array->crotal,
        ]);
        $padre=Ganado::where('crotal',$array->padre)->first();
        if(empty($padre)){
            $padre=Ganado::create([
                'crotal'    =>  $array->padre,
            ]);
            $padre->setSexo(Sexo::find(1));
        }
        $madre=Ganado::where('crotal',$array->madre)->first();
        if(empty($madre)){
            $madre=Ganado::create([
                'crotal'    =>  $array->madre,
            ]);
            $madre->setSexo(Sexo::find(2));
        }
        $padre->setHijoP($ganado);
        $madre->setHijoM($ganado);
        $ganado->setSexo(Sexo::where('alias',$array->sexo)->first());
        $ganado->setCapa(Capa::where('alias',$array->capa)->first());
        $ganado->setEstado(Estado::where('nombre',$array->estado)->first());
        if(!empty($array->ganaderia)){
            $ganaderia=Ganaderia::where([
                'nombre'    =>  $array->ganaderia,
                'sigla'     =>  $array->sigla
            ])->first();
            if(!empty($ganaderia)){

                $ganado->setGanaderia($ganaderia);
            }else{

                $ganado->setGanaderia(Ganaderia::GanaderiaVacia($array->ganaderia,$array->sigla));
            }

        }else{
            $ganado->setGanaderia(Ganaderia::GanaderiaVacia("Ganadería Vacia","VACI"));
        }
        $ganado->setFechaNacimiento(DateTime::createFromFormat('d/m/Y',$array->fecha_de_nacimiento));
        return $ganado;

    }


    private static function actualizarXLS($array, $oganado)
    {
        $padre=Ganado::where('crotal',$array->padre)->first();
        if(empty($padre)){
            $padre=Ganado::create([
                'crotal'    =>  $array->padre,
            ]);
            $padre->setSexo(Sexo::find(1));
        }
        $madre=Ganado::where('crotal',$array->madre)->first();
        if(empty($madre)){
            $madre=Ganado::create([
                'crotal'    =>  $array->madre,
            ]);
            $madre->setSexo(Sexo::find(2));
        }
        $padre->setHijoP($oganado);
        $madre->setHijoM($oganado);
        $oganado->setSexo(Sexo::where('alias',$array->sexo)->first());
        $oganado->setCapa(Capa::where('alias',$array->capa)->first());
        $oganado->setEstado(Estado::where('nombre',$array->estado)->first());
        if(!empty($array->ganaderia)){
            $ganaderia=Ganaderia::where([
                'nombre'    =>  $array->ganaderia,
                'sigla'     =>  $array->sigla
            ])->first();
            if(!empty($ganaderia)){

                $oganado->setGanaderia($ganaderia);
            }else{

                $oganado->setGanaderia(Ganaderia::GanaderiaVacia($array->ganaderia,$array->sigla));
            }

        }else{
            $oganado->setGanaderia(Ganaderia::GanaderiaVacia("Ganadería Vacia","VACI"));
        }

        $oganado->setFechaNacimiento(DateTime::createFromFormat('d/m/Y',$array->fecha_de_nacimiento));
        return $oganado;

    }

    public static function ganadosAExportar(){
        if(Auth::user()->hasAnyRole(array('Administrador','SuperAdmin'))){
            $ganados=Ganado::all()->sortBy('crotal')->sortBy('estado_id');
        }else{

            if(Auth::user()->ganaderia){
                $ganados=Auth::user()->ganaderia->ganados->sortBy('crotal')->sortBy('estado_id');
            }else{
                $ganados=collect(new Ganado);

            }

        }
        return $ganados;
    }

    public static function generateArrayForExport(){
        $ganados=Ganado::ganadosAExportar();
        $array=array();
        foreach ($ganados as $ganado){
            if (empty($ganado->padre->crotal)){
                $padre="no definido";
            }else{
                $padre=$ganado->padre->crotal;
            }
            if (empty($ganado->madre->crotal)){
                $madre="no definido";
            }else{
                $madre=$ganado->madre->crotal;
            }
            // Arreglar fallo exportar a veces
            if (isset($ganado->ganaderia->nombre)){
                $ganaderianombre=$ganado->ganaderia->nombre;
                $ganaderiasigla=$ganado->ganaderia->sigla;
            }else{
                $ganaderianombre="Ganadería Vacia";
                $ganaderiasigla="VACI";

            }
            $aux=[
                'fecha de nacimiento'   =>  $ganado->fecha_nacimiento->format('d/m/Y'),
                'crotal'                =>  $ganado->crotal,
                'padre'                 =>  $padre,
                'madre'                 =>  $madre,
                'capa'                  =>  $ganado->capa->alias,
                'sexo'                  =>  $ganado->sexo->alias,
                'estado'                =>  $ganado->estado->nombre,
                'ganaderia'             =>  $ganaderianombre,
                'sigla'                 =>  $ganaderiasigla,

            ];

            array_push($array,$aux);
        }
        return $array;
    }


    public static function importarXLS($reader)
    {
        $insert=array();
        foreach ($reader->get() as $ganado) {
            $oganado=Ganado::where('crotal',$ganado->crotal)->first();
            if(empty($oganado)){

                array_push($insert,self::guardarNuevoXLS($ganado));

            }else{

                array_push($insert,self::actualizarXLS($ganado,$oganado));

            }
        }

        return $insert;
    }
}
