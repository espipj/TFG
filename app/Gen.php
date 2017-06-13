<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gen extends Model
{
    //
    protected $fillable = ['marcadores', 'nombres'];
    protected $table = 'genes'; //hemos cambiado el nombre por defecto de la tabla
    protected $casts = [
        'marcadores' => 'array',
        'nombres' => 'array'
    ];

    public function ganado()
    {
        return $this->belongsTo(Ganado::class);
    }

    public function asignarGanado($ganado)
    {
        return $ganado->gen()->save($this);
    }

    /**
     * @param $genP
     * @param $genM
     * @param $genH
     * @return mixed
     * Calcula la probabilidad del genH de ser descendiente del genP dada la madre genM
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
     * Aplicamos la formula según el algoritmo
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
     * @param $alelo
     * @param $marcador
     * @return mixed
     * Calcula la frecuencia con la que se repite un Alelo en un dataset
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
     * @param $alelo
     * Calcula la posicion del marcador en el array de marcadores
     */
    public static function posicionMarcador($marcador)
    {
        $gen = Gen::find(1);
        $nombres = $gen->nombres;
        return array_search($marcador, $nombres);
    }

    public static function guardarNuevoXLS($gen)
    {
        //return dd(Gen::all());
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
        return $gen;
    }

    public function actualizarXLS($ganado, $oganado)
    {

    }

    public static function importarXLS($reader)
    {
        $insert = array();
        //return dd($reader->get());
        foreach ($reader->get() as $gen) {
            //$oganado=Ganado::where('crotal',$ganado->crotal)->first();
            //return dd($gen);
            array_push($insert, self::guardarNuevoXLS($gen));


        }

        return $insert;
    }
}
