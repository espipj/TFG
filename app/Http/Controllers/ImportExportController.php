<?php

namespace App\Http\Controllers;

use App\Explotacion;
use App\Ganaderia;
use App\Ganado;
use App\Gen;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;


/**
 * Class ImportExportController.
 *
 * Controller used for the import and export of the data to/from our system.
 *
 * @package App\Http\Controllers
 * @author Pablo Espinosa <espipj@gmail.com>
 */
class ImportExportController extends Controller
{


    /**
     * Function that checks the option (A model) we want to export and the format of file we want to generate (XLS/CSV)
     *
     * @param string $opcion Option with the Model we want to export.
     * @param string $formato Format of the file we want to generate.
     */
    public function exportar($opcion, $formato){
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
            case 'explotacion':
                $nombre='Genes'. '_' .Carbon::now()->format('d-m-Y');
                //dd(Ganaderia::generateArrayForExport());
                $hoja="Genes";
                $this->downloadExcel($formato,Explotacion::generateArrayForExport(),$nombre,$hoja);
                break;
        }
    }

    /**
     * Function that call the function of each model to import data from a XLS file.
     *
     *
     * @param string $opcion The string that names the Model we want to import.
     * @return \Illuminate\Http\RedirectResponse Brings us back to the page the user was before.
     */
    public function importar($opcion){

        if(Input::hasFile('import_file')) {
            //ini_set('memory_limit','256M');
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
            case 'explotacion':
                Explotacion::importarXLS($reader);
                return back();
                break;
        }

    }

    /**
     * @deprecated Function no longer used, It was used for the initial development.
     *
     * @param string $opcion
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_importar($opcion){
        switch ($opcion){
            case 'ganado':
                return view('ganado.importarGanado');
                break;
        }

    }

    /**
     * Calls the function to create and download the file generated with the data.
     *
     * @param string $type The format of the file.
     * @param array $data The array with all the data we want to export.
     * @param string $nombre Name of the file we want to generate.
     * @param string $hoja Name of the sheet.
     * @return mixed It just downloads the file.
     */
    public function downloadExcel($type, $data, $nombre, $hoja)
    {
        return Excel::create($nombre, function($excel) use ($data,$hoja) {
            $excel->sheet($hoja, function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
