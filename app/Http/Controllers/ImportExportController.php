<?php

namespace App\Http\Controllers;

use App\Ganaderia;
use App\Ganado;
use App\Gen;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class ImportExportController extends Controller
{


    public function exportar($opcion,$formato){
        switch ($opcion){
            case 'ganado':
                $nombre='Ganados'. '_' .Carbon::now()->format('d-m-Y');
                //$array=Ganado::get(['fecha_nacimiento','crotal','padre_id','madre_id','capa','sexo_id'])->toArray();
                $hoja="Ganados";
                $this->downloadExcel($formato,Ganado::generateArrayForExport(),$nombre,$hoja);
                break;
            case 'ganaderia':
                $nombre='Ganaderias'. '_' .Carbon::now()->format('d-m-Y');
                //dd(Ganaderia::generateArrayForExport());
                $hoja="Ganaderias";
                $this->downloadExcel($formato,Ganaderia::generateArrayForExport(),$nombre,$hoja);
                break;
            case 'genes':
                $nombre='Genes'. '_' .Carbon::now()->format('d-m-Y');
                //dd(Ganaderia::generateArrayForExport());
                $hoja="Genes";
                $this->downloadExcel($formato,Gen::generateArrayForExport(),$nombre,$hoja);
                break;
        }
    }

    public function importar($opcion){

        if(Input::hasFile('import_file')) {
            ini_set('memory_limit','256M');
            $path = Input::file('import_file')->getRealPath();
            $reader = Excel::load($path);
        }else {
            return  back();
        }
        switch ($opcion){
            case 'ganado':
                    Ganado::importarXLS($reader);

                return back();
                break;
            case 'ganaderia':
                Ganaderia::importarXLS($reader);

                return back();
                break;
            case 'genes':
                Gen::importarXLS($reader);
                return back();
                break;
        }

    }
    public function show_importar($opcion){
        switch ($opcion){
            case 'ganado':
                return view('ganado.importarGanado');
                break;
        }

    }
    public function downloadExcel($type,$data,$nombre,$hoja)
    {
        return Excel::create($nombre, function($excel) use ($data,$hoja) {
            $excel->sheet($hoja, function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
