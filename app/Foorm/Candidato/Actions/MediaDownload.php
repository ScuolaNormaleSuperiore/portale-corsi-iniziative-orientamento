<?php

namespace App\Foorm\Candidato\Actions;

use App\Enums\GareInternazionali;
use App\Enums\GareUmanistiche;
use App\Enums\GiochiChimica;
use App\Enums\OlimpiadiFisica;
use App\Enums\OlimpiadiFisicaSquadreMiste;
use App\Enums\OlimpiadiInformatica;
use App\Enums\OlimpiadiMatematica;
use App\Enums\OlimpiadiMatematicaSquadre;
use App\Enums\OlimpiadiMatematicaSquadreFemminili;
use App\Enums\OlimpiadiScienzeNaturali;
use App\Enums\Stages;
use App\Models\LivelloLinguistico;
use App\Models\Materia;
use App\Models\ModalitaConoscenzaSns;
use App\Models\Professione;
use App\Models\Provincia;
use App\Models\Regione;
use App\Models\TitoloStudio;
use App\Services\FormatValues;
use Carbon\Carbon;
use Gecche\Cupparis\App\Foorm\Base\Actions\CsvExport as BaseCsvExport;
use Gecche\Foorm\FoormAction;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaDownload extends FoormAction
{

    protected $relation = null;
    protected $prefixFilename = null;

    protected function init()
    {
        parent::init();
        $this->relation = Arr::get($this->input,'relation','attachments');
        $this->prefixFilename = Arr::get($this->input,'prefixFilename',$this->foorm->getModelRelativeName()."_".Str::studly($this->relation));
    }

    public function validateAction()
    {

        return true;

    }



    public function performAction()
    {

        $mediaCollection = $this->model->{$this->relation};


        $files = [];


        foreach ($mediaCollection as $mediaObject) {
            if($mediaObject->fileExists()) {
                $files[$mediaObject->nome] = storage_path($mediaObject->getStorageFilename());
//                $files[$mediaObject->full_filename] = Storage::get($mediaObject->getStorageFilename());
            }
        }

        if (count($files) <= 0) {
            throw new \Exception("Nessun file da scaricare");
        }
        $zipName = $this->prefixFilename . '_' . $this->model->getKey() . "_" . date("Ymd_His");
        $zip = $this->_creaZip($zipName,$files);
        $this->actionResult = [
            'content' => base64_encode(File::get(storage_temp_path($zip))),
            'mime' => 'application/x-zip',
            'name' => $zip,
        ];
        return $this->actionResult;

    }

    protected function _creaZip($baseName,$files) {
        $zip_file = "$baseName" .date('Y-m-d_H_i') . ".zip";
        $zip_path = storage_path($zip_file);
        $zip = new \ZipArchive();

        $zip->open($zip_path, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);


        foreach ($files as $nome => $file)
        {
            if (is_numeric($nome)) {
                $nome = $file;
            }
            $relativeFile = Str::afterLast($nome,'/');
            $zip->addFile($file, $relativeFile);
        }
        $zip->close();
        rename($zip_path,storage_temp_path("$baseName.zip"));
        return "$baseName.zip";
    }

}
