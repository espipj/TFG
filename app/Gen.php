<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Gen
 * @package App
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class Gen extends Model
{
    /**
     * Array with the fillable attributes of the class.
     *
     * @var array List of attributes of the class. Contains the gen marker name, and the value of the marker.
     */
    protected $fillable = ['marcadores', 'nombres'];

    /**
     * Name of the table/migration that is associated with this Model.
     * @var string
     */
    protected $table = 'genes'; //hemos cambiado el nombre por defecto de la tabla
    /**
     * A casting for our two arrays of Genetics markers and names we have.
     * This way we can work in an easy way with them with Eloquent
     * @var array
     */
    protected $casts = [
        'marcadores' => 'array',
        'nombres' => 'array'
    ];


    /**
     * Definition of the relationship BelongsTo Ganado.
     *
     * We need to define Eloquent our relationships in order to work with it.
     * A Gen, BelongsTo Ganado.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Relationship BelongsTo
     */
    public function ganado()
    {
        return $this->belongsTo(Ganado::class);
    }

    /**
     * Function made in order to asign a gen to a ganado.
     * @param $ganado
     * @return mixed
     */
    public function asignarGanado($ganado)
    {
        return $ganado->gen()->save($this);
    }

    /**
     * Main function to calculate the probability of the filiation.
     *
     * Calculates the probability of the $genH of being descendant of $genP and $genM.
     *
     * @param Gen $genP Genetic Data of the father.
     * @param Gen $genM Genetic Data of the mother.
     * @param Gen $genH Genetic Data of the son.
     * @return array Array with the results of the filiation.
     * @see Gen::aplicarFormula()
     */
    public static function calcularProbabilidad($genP, $genM, $genH)
    {
        $resultados = array();

        foreach ($genH->marcadores as $key => $marcador) {
            array_push($resultados, Gen::aplicarFormula($genP->marcadores[$key], $genM->marcadores[$key], $marcador, $key));
            if ($key == 0) {
                $resultado = Gen::aplicarFormula($genP->marcadores[$key], $genM->marcadores[$key], $marcador, $key);
            } else {
                $resultado *= Gen::aplicarFormula($genP->marcadores[$key], $genM->marcadores[$key], $marcador, $key);
            }
        }

        return [$resultados, $resultado, ($resultado / ($resultado + 1))];
    }

    /**
     * Function to calculate the probability of the filiation without a known father.
     *
     * Calculates the probability of the $genH of being descendant evey male at our system and $genM.
     *
     * @param Gen $genM Genetic Data of the mother.
     * @param Gen $genH Genetic Data of the son.
     * @return array Array with the results of the filiation ordered by probability.
     * @see Gen::calcularProbabilidad()
     */
    public static function calcularProbabilidadSP($genM, $genH)
    {
        $resultado = array();
        $machos = Ganado::where('sexo_id', 1)->get();
        foreach ($machos as $padre) {
            if (isset($padre->gen)) {
                if ($padre->gen == $genH) {
                    continue;
                }
                array_push($resultado, array(self::calcularProbabilidad($padre->gen, $genM, $genH), $padre));
            }
        }

        //Ordenamos por probabilidad
        usort($resultado, function ($a, $b) {
            return $b[0][2] <=> $a[0][2];
        });
        return $resultado;
    }


    /**
     * Function that applies Evett and Weir formula in order to calculate the probability.
     * @param integer $aP Allele from the father.
     * @param integer $aM Allele from the mother.
     * @param integer $aH Allele from the son.
     * @param string $marcador Genetic Marker name.
     * @return float|int|string Returns a coefficient.
     * @see Gen::calcularFrecuenciaAlelo()
     * @uses Gen::calcularFrecuenciaAlelo()
     */
    public static function aplicarFormula($aP, $aM, $aH, $marcador)
    {
        $P = 0;


        if ($aH[0] == $aH[1]) {
            $nigualM = 0;
            foreach ($aM as $key => $alM) {
                if (in_array($alM, $aH)) {
                    $igualM = $key;
                    $nigualM++;
                }
            }
            if ($nigualM != 0) {
                $nigualP = 0;
                foreach ($aP as $key => $alP) {
                    if (in_array($alP, $aH)) {
                        $igualP = $key;
                        $nigualP++;
                    }
                }
                if ($nigualP == 1) {
                    return 1 / (2 * (self::calcularFrecuenciaAlelo($aP[$igualP], $marcador)));
                } elseif ($nigualP == 2) {
                    return 1 / self::calcularFrecuenciaAlelo($aP[0], $marcador);
                } else {
                    return 0;
                }

            } else {
                return "Error, la madre no tiene ningun alelo igual en el marcador:" . $marcador;
            }
        } else {
            $nigualM = 0;
            $aux = -1;
            foreach ($aM as $key => $alM) {
                if (in_array($alM, $aH)) {
                    $igualM = $key;
                    if ($alM != $aux) {
                        $nigualM++;
                    }
                    $aux = $alM;
                }
            }

            if ($nigualM == 2) {
                $nigualP = 0;
                foreach ($aP as $key => $alP) {
                    if (in_array($alP, $aH)) {
                        $igualP = $key;
                        $nigualP++;
                    }
                }
                if ($nigualP == 1) {
                    return 1 / (2 * (self::calcularFrecuenciaAlelo($aH[0], $marcador) + self::calcularFrecuenciaAlelo($aH[1], $marcador)));
                } elseif ($nigualP == 2) {
                    return 1 / (self::calcularFrecuenciaAlelo($aH[0], $marcador) + self::calcularFrecuenciaAlelo($aH[1], $marcador));
                } else {
                    return 0;
                }

            } elseif ($nigualM == 1) {
                $nigualP = 0;
                $aux = -1;
                foreach ($aP as $key => $alP) {
                    if (in_array($alP, $aH)) {
                        $nigualP++;
                        $igualP = $key;
                        break;
                    }
                }

                if ($nigualP > 0) {
                    if ($aP[0] == $aP[1]) {

                        return 1 / (self::calcularFrecuenciaAlelo($aP[0], $marcador));

                    } else {
                        return 1 / (2 * (self::calcularFrecuenciaAlelo($aP[$igualP], $marcador)));
                    }

                } else {
                    return 0;
                }

            } else {
                return "Error, la madre no tiene ningun alelo igual en el marcador:" . $marcador;
            }

        }


    }

    /**
     * Function that calculates the frequency that a certain Allele is repeated on our database.
     * @param integer $alelo The value of the Allele we are calculating
     * @param $marcador
     * @return mixed Returns the coefficient of probability of that Allele in our database
     * @uses Gen::posicionMarcador()
     * @see Gen::posicionMarcador()
     *
     */
    public static function calcularFrecuenciaAlelo($alelo, $marcador)
    {
        $pos = $marcador;
        if (!is_numeric($marcador)) {
            $pos = self::posicionMarcador($marcador);
        }
        $genes = Gen::all();
        $n = 0;
        $total = count($genes);
        foreach ($genes as $gen) {
            $marcador = $gen->marcadores[$pos];
            foreach ($marcador as $malelo) {
                if ($alelo == $malelo) {
                    $n++;
                    break;
                }
            }
        }

        return $n / $total;
    }

    /**
     * Calculates the position of the Genetic Marker in the array
     * @param string $marcador
     * @return integer The position of the Genetic marker in the array
     */
    public static function posicionMarcador($marcador)
    {
        $gen = Gen::find(1);
        $nombres = $gen->nombres;
        return array_search($marcador, $nombres);
    }

    /**
     * Helper function for importarXLS
     * Saves a new Gen with the data of an import file.
     * @param array $gen The array with the data of a new Gen.
     * @return Ganaderia|static The that has just been created.
     * @see Gen::importarXLS()
     */
    public static function guardarNuevoXLS($gen)
    {
        //return dd(Gen::all());

        $aux = Gen::create([
            'nombres' => array('TGLA227', 'BM2113', 'TGLA53', 'ETH10', 'SPS115', 'TGLA126', 'TGLA122', 'INRA23', 'BM1818', 'ETH3', 'ETH225', 'BM1824'),
            'marcadores' => array(
                array($gen->tgla227_1, $gen->tgla227_2),
                array($gen->bm2113_1, $gen->bm2113_2),
                array($gen->tgla53_1, $gen->tgla53_2),
                array($gen->eth10_1, $gen->eth10_2),
                array($gen->sps115_1, $gen->sps115_2),
                array($gen->tgla126_1, $gen->tgla126_2),
                array($gen->tgla122_1, $gen->tgla122_2),
                array($gen->inra023_1, $gen->inra023_2),
                array($gen->bm1818_1, $gen->bm1818_2),
                array($gen->eth3_1, $gen->eth3_2),
                array($gen->eth225_1, $gen->eth225_2),
                array($gen->bm1824_1, $gen->bm1824_2)),

        ]);

        $ganado=Ganado::where('crotal',$gen->crotal)->first();
        if(isset($ganado)){
            $ganado->gen()->save($aux);
        }else{

            $ganado=Ganado::crearVacio($gen->crotal,Carbon::now());
            $ganado->gen()->save($aux);
        }

        return $gen;
    }

    /**
     * Helper function for importarXLS
     * Updates a Gen with the data of an import
     * @param array $gen The array with the data to update Gen.
     * @param Gen $ogen Gen to be updated.
     * @return Gen|static The Gen that has just been updated.
     * @see Gen::importarXLS()
     * @TODO Develop the function
     */
    public static function actualizarXLS($gen, $oganado)
    {

        $gen = Gen::create([
            'nombres' => array('TGLA227', 'BM2113', 'TGLA53', 'ETH10', 'SPS115', 'TGLA126', 'TGLA122', 'INRA23', 'BM1818', 'ETH3', 'ETH225', 'BM1824'),
            'marcadores' => array(
                array($gen->tgla227_1, $gen->tgla227_2),
                array($gen->bm2113_1, $gen->bm2113_2),
                array($gen->tgla53_1, $gen->tgla53_2),
                array($gen->eth10_1, $gen->eth10_2),
                array($gen->sps115_1, $gen->sps115_2),
                array($gen->tgla126_1, $gen->tgla126_2),
                array($gen->tgla122_1, $gen->tgla122_2),
                array($gen->inra023_1, $gen->inra023_2),
                array($gen->bm1818_1, $gen->bm1818_2),
                array($gen->eth3_1, $gen->eth3_2),
                array($gen->eth225_1, $gen->eth225_2),
                array($gen->bm1824_1, $gen->bm1824_2)),

        ]);
        $oganado->gen->delete();
        $oganado->gen()->save($gen);
        return $gen;

    }

    /**
     * Main function for import of the Model Gen.
     *
     * Checks if the Gen already exists and if so it just updates it.
     * If not it creates a new one.
     * @uses Gen::actualizarXLS()
     * @uses Gen::guardarNuevoXLS()
     * @see Gen::actualizarXLS()
     * @see Gen::guardarNuevoXLS()
     * @param $reader
     * @return array With every Gen updated or created.
     */
    public static function importarXLS($reader)
    {
        $insert = array();
        //return dd($reader->get());
        foreach ($reader->get() as $gen) {

            $oganado=Ganado::where('crotal',$gen->crotal)->first();
            if(isset($oganado) && isset($oganado->gen)){

                array_push($insert, self::actualizarXLS($gen,$oganado));
            }else{

                //return dd($gen);
                array_push($insert, self::guardarNuevoXLS($gen));
            }


        }

        return $insert;
    }

    public static function generateArrayForExport()
    {
        //'nombres' => array('TGLA227', 'BM2113', 'TGLA53', 'ETH10', 'SPS115', 'TGLA126', 'TGLA122', 'INRA23', 'BM1818', 'ETH3', 'ETH225', 'BM1824'),

        $ganados=Ganado::ganadosUser(Auth::user());
        $array=array();
        foreach ($ganados as $ganado){
            if(isset($ganado->gen)){
                $gen=$ganado->gen;

                $aux=[
                    'crotal'=>$ganado->crotal,
                    'tgla227_1'=>$gen->marcadores[0][0],
                    'tgla227_2'=>$gen->marcadores[0][1],
                    'bm2113_1'=>$gen->marcadores[1][0],
                    'bm2113_2'=>$gen->marcadores[1][1],
                    'tgla53_1'=>$gen->marcadores[2][0],
                    'tgla53_2'=>$gen->marcadores[2][1],
                    'eth10_1'=>$gen->marcadores[3][0],
                    'eth10_2'=>$gen->marcadores[3][1],
                    'sps115_1'=>$gen->marcadores[4][0],
                    'sps115_2'=>$gen->marcadores[4][1],
                    'tgla126_1'=>$gen->marcadores[5][0],
                    'tgla126_2'=>$gen->marcadores[5][1],
                    'tgla122_1'=>$gen->marcadores[6][0],
                    'tgla122_2'=>$gen->marcadores[6][1],
                    'inra023_1'=>$gen->marcadores[7][0],
                    'inra023_2'=>$gen->marcadores[7][1],
                    'bm1818_1'=>$gen->marcadores[8][0],
                    'bm1818_2'=>$gen->marcadores[8][1],
                    'eth3_1'=>$gen->marcadores[9][0],
                    'eth3_2'=>$gen->marcadores[9][1],
                    'eth225_1'=>$gen->marcadores[10][0],
                    'eth225_2'=>$gen->marcadores[10][1],
                    'bm1824_1'=>$gen->marcadores[11][0],
                    'bm1824_2'=>$gen->marcadores[11][1],


                ];

                array_push($array,$aux);
            }
        }
        //dd($array);
        return $array;
    }

}
