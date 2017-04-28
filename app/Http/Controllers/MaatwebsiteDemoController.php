<?php

namespace App\Http\Controllers;

use App\Explotacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class MaatwebsiteDemoController extends Controller
{
    //

    public function importExport()
    {
        return view('importExport');
    }
    public function downloadExcel($type)
    {
        $data = Explotacion::get()->toArray();
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    public function importExcel()
    {

        if(Input::hasFile('import_file')){

            //Config::set('excel.csv.delimiter', ';');
            $path = Input::file('import_file')->getRealPath();
            $reader=Excel::load($path);

                foreach ($reader->get() as $explotacion) {
                    //$insert[] = ['codigo_explotacion' => $value->COD_EXPLOTACION, 'municipio' => $value->MUNICIPIO];
                    $insert[] = $explotacion;

                    Explotacion::create([
                                            'cod_explotacion'   => $explotacion->cod_explotacion,
                                            'municipio'         => $explotacion->municipio
                                        ]);
                }
                /*if(!empty($insert)){
                    DB::table('explotaciones')->insert($insert);
                    dd('Insert Record successfully.');
                }
                */

                dd($insert);

        }
        return back();
    }

}
