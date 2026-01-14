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
use App\Exports\ModelArrayExport;
use App\Models\LivelloLinguistico;
use App\Models\Materia;
use App\Models\ModalitaConoscenzaSns;
use App\Models\Nazione;
use App\Models\Professione;
use App\Models\Provincia;
use App\Models\Regione;
use App\Models\TitoloStudio;
use App\Services\FormatValues;
use Carbon\Carbon;
use Gecche\Cupparis\App\Foorm\Base\Actions\CsvExport as BaseCsvExport;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class XlsExport extends BaseCsvExport
{

    use XlsExportTrait;

    protected function init()
    {
        parent::init();
        $this->setDatiGenerali();
    }



    public function performAction()
    {
        $csvStream = '';
//        if (Arr::get($this->csvSettings, 'headers', true)) {
//            $csvStream .= $this->getCsvRowHeaders();
//        }

        $transUc = trans_choice_uc('model.' . $this->csvModelName, 2);
        $relativeFilename = str_replace(' ', '_', $transUc)
            . '_' . date('Ymd_His') . ".xlsx";
        $filename = storage_temp_path($relativeFilename);
        $storageFilename = Str::replace(storage_path(),'',$filename);
//        File::put($filename, $csvStream);
        switch ($this->formType) {
            case 'list':
                $dataArray = $this->performActionList($csvStream);
                break;
            default:
                break;
        }

        $columnsFormats = [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'I' => NumberFormat::FORMAT_TEXT,
        ];
        Excel::store(new ModelArrayExport($dataArray,$columnsFormats), $storageFilename);


        $name = "Candidature_" . date("Ymd_His") . ".xlsx";
        $this->actionResult = [
            'content' => base64_encode(File::get($filename)),
            'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'name' => $name,
        ];
        return $this->actionResult;

    }

    protected function performActionList($csvStream,$filename = null)
    {
        $dataArray = [
            $this->getCsvRowHeaders()
        ];
        $builder = $this->getFoormBuilder();
        $clonedBuilder = clone($builder);

        $i = 1;
        $perPage = 1000;
        $finito = false;
        while (!$finito) {

            $page = $i;

            $skip = ($page - 1) * $perPage;
            $builder = $builder->take($perPage)->skip($skip)->get();

//            $chunkData = $builder->toArray();

            if ($builder->count() >= 1) {
                $dataArray = array_merge($dataArray,$this->getDataFromChunk($builder));

                $builder = $clonedBuilder;
            } else {
                $finito = true;
            }
            $i++;
        }

        return $dataArray;
    }

    protected function getDataFromChunk($chunkData)
    {
        $csvChunkArray = [];

        foreach ($chunkData as $item) {
            $csvChunkArray[] = $this->getCsvRow($item);
        }

        return $csvChunkArray;

    }

    public function getCsvRow($item)
    {
        $row = [];
        $itemArray = $item->toArray();
        $itemDotted = Arr::dot($itemArray);
        foreach ($this->fields as $key) {
            $methodKey = str_replace('|', '', $key);

            $itemValue = $this->guessItemValue($key,$itemDotted,$itemArray,$item);

//            Log::info("FIELD:::");
//            Log::info($key);

            $methodName = 'getCsvField' . Str::studly($methodKey);
            if (method_exists($this, $methodName)) {
                $field =  $this->$methodName($itemValue,$itemArray,$item);
                if (is_array($field)) {
                    foreach ($field as $currfield) {
                        $row[] = $currfield;
                    }
                } else {
                    $row[] = $field;
                }
//                Log::info("VALUE:::");
//                Log::info($field);
            } else {
                $row[] = $this->getCsvFieldStandard($key, $itemValue, $itemArray,$item);
            }
//            Log::info("ROW:::");
//            Log::info($row);
        }
        return $row;
    }


}
