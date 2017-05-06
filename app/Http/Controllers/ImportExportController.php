<?php

namespace App\Http\Controllers;

use App\Ganaderia;
use App\Ganado;
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

                $this->downloadExcel($formato,Ganado::generateArrayForExport(),$nombre);
                break;
            case 'ganaderia':
                $nombre='Ganaderias'. '_' .Carbon::now()->format('d-m-Y');
                dd(Ganaderia::generateArrayForExport());
                $this->downloadExcel($formato,Ganaderia::generateArrayForExport(),$nombre);
                break;
        }
    }

    public function downloadExcel($type,$data,$nombre)
    {
        return Excel::create($nombre, function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
