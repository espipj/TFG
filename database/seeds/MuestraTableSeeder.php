<?php

use App\Ganado;
use App\Gen;
use App\Laboratorio;
use App\Muestra;
use App\Sexo;
use App\TipoConsulta;
use App\TipoMuestra;
use Illuminate\Database\Seeder;

class MuestraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $muestras = factory(Muestra::class)->times(60)->make();
        $ganados= Ganado::all();
        $tipomuestras= TipoMuestra::all();
        $tipoconsultas= TipoConsulta::all();
        $laboratorios= Laboratorio::all();

        foreach ($muestras as $muestra){
            $muestra->setGanado($ganados->random());
            $muestra->setLaboratorio($laboratorios->random());
            $muestra->setTipoConsulta($tipoconsultas->random());
            $muestra->setTipoMuestra($tipomuestras->random());
        }

        $madre=Ganado::create([
            'crotal'    => 'MADRE',
        ]);
        $madre->setSexo(Sexo::find(2));
        $padre=Ganado::create([
            'crotal'    => 'PADRE',
        ]);
        $padre->setSexo(Sexo::find(1));
        $hijo=Ganado::create([
            'crotal'    => 'HIJO',
        ]);

        $padre->setHijoP($hijo);
        $madre->setHijoM($hijo);

        $gen=Gen::create([
            'nombres'   =>  array('TGLA227','BM2113','TGLA53','ETH10','SPS115','TGLA126','TGLA122','INRA23','BM1818','ETH3','ETH225','BM1824'),
            'marcadores'=>  array(array(87,91),array(133,141),array(166,170),array(213,217),array(254,256),array(111,121),
                array(143,153),array(206,214),array(266,266),array(123,125),array(140,150),array(182,188)),

        ]);
        $gen->asignarGanado($hijo);

        $gen=Gen::create([
            'nombres'   =>  array('TGLA227','BM2113','TGLA53','ETH10','SPS115','TGLA126','TGLA122','INRA23','BM1818','ETH3','ETH225','BM1824'),
            'marcadores'=>  array(
                array(83,91),
                array(133,137),
                array(156,166),
                array(209,213),
                array(248,254),
                array(111,123),
                array(153,153),
                array(206,206),
                array(258,266),
                array(123,125),
                array(140,148),
                array(180,188)),
        ]);
        $gen->asignarGanado($madre);

        $gen=Gen::create([
            'nombres'   =>  array('TGLA227','BM2113','TGLA53','ETH10','SPS115','TGLA126','TGLA122','INRA23','BM1818','ETH3','ETH225','BM1824'),
            'marcadores'=>  array(array(81,87),array(139,141),array(168,170),array(217,221),array(256,256),array(121,121)
            ,array(143,161),array(208,214),array(266,266),array(109,125),array(144,150),array(182,188)),
        ]);
        $gen->asignarGanado($padre);


    //Segunda

        $madre=Ganado::create([
            'crotal'    => 'MADRE1',
        ]);
        $madre->setSexo(Sexo::find(2));
        $padre=Ganado::create([
            'crotal'    => 'PADRE1',
        ]);
        $padre->setSexo(Sexo::find(1));
        $hijo=Ganado::create([
            'crotal'    => 'HIJO1',
        ]);


        $padre->setHijoP($hijo);
        $madre->setHijoM($hijo);

        $gen=Gen::create([
            'nombres'   =>  array('TGLA227','BM2113','TGLA53','ETH10','SPS115','TGLA126','TGLA122','INRA23','BM1818','ETH3','ETH225','BM1824'),
            'marcadores'=>  array(
                array(89,97),
                array(137,137),
                array(160,162),
                array(217,219),
                array(248,248),
                array(119,121),
                array(153,153),
                array(214,214),
                array(266,266),
                array(125,125),
                array(148,148),
                array(178,182)),
        ]);
        $gen->asignarGanado($hijo);

        $gen=Gen::create([
            'nombres'   =>  array('TGLA227','BM2113','TGLA53','ETH10','SPS115','TGLA126','TGLA122','INRA23','BM1818','ETH3','ETH225','BM1824'),
            'marcadores'=>  array(
                array(91,97),
                array(125,137),
                array(160,164),
                array(217,219),
                array(248,248),
                array(121,123),
                array(149,153),
                array(214,214),
                array(266,266),
                array(117,125),
                array(148,150),
                array(180,182)),
        ]);
        $gen->asignarGanado($padre);

        $gen=Gen::create([
            'nombres'   =>  array('TGLA227','BM2113','TGLA53','ETH10','SPS115','TGLA126','TGLA122','INRA23','BM1818','ETH3','ETH225','BM1824'),
            'marcadores'=>  array(
                array(89,93),
                array(135,137),
                array(160,162),
                array(209,217),
                array(248,248),
                array(119,121),
                array(153,153),
                array(214,214),
                array(262,266),
                array(125,127),
                array(140,148),
                array(178,190)),
        ]);
        $gen->asignarGanado($madre);
    }
}
