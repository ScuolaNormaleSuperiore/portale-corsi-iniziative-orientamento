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

    protected $regioni = null;
    protected $province = null;

    protected $livelliLinguistici = null;
    protected $professioni = null;
    protected $titoliStudio = null;
    protected $modalita = null;

    protected $materie = null;

    protected function init()
    {
        parent::init();
        $this->nazioni = Nazione::all()
            ->pluck('nome', 'id')->all();
        $this->regioni = Regione::all()
            ->pluck('nome', 'id')->all();
        $this->province = Provincia::all()
            ->pluck('nome', 'id')->all();
        $this->livelliLinguistici = LivelloLinguistico::all()
            ->pluck('nome', 'id')->all();
        $this->titoliStudio = TitoloStudio::all()
            ->pluck('nome', 'id')->all();
        $this->professioni = Professione::all()
            ->pluck('nome', 'id')->all();
        $this->modalita = ModalitaConoscenzaSns::all()
            ->pluck('nome', 'id')->all();
        $this->materie = Materia::all()
            ->pluck('nome', 'id')->all();
    }

    public function getCsvRowHeaders()
    {

        $headers = [
            'Cognome',
            'Nome',
            'Codice fiscale',
            'Genere',
            'Luogo di nascita',
            'Data di nascita',
            'Residenza o recapito postale',
            'CAP',
            'Comune',
            'Comune (catastale)',
            'Provincia',
            'Regione',
            'Nazione',
            'Telefono',
            'Email',
            'Titolo di studio del padre',
            'Titolo di studio della madre',
            'Tipo di scuola',
            'classe',
            'Regione della scuola',
            'Candidati selezionati nella scuola nel biennio precedente',
            'Denominazione scuola',
            'Email scuola',
            'Profilo',

            'Olimpiadi di matematica',
            'Olimpiadi di matematica a squadre',
            'Olimpiadi di matematica a squadre femminili',
            'Olimpiadi di fisica',
            'Olimpiadi di fisica a squadre miste',
            'Olimpiadi di scienze naturali',
            'Giochi della chimica',
            'Olimpiadi di informatica',

            'Partecipazione a stages',
            'Partecipazione a gare internazionali',
            'Partecipazione a gare umanistiche',

            'Altre partecipazioni a concorsi',
            'Inglese',
            'Francese',
            'Tedesco',
            'Spagnolo',
            'Cinese',
            'Altre competenze linguistiche',
            'Esperienze all\'estero',
            'Materie di studio',
            'Settore professionale',
            'Motivazioni',
            'Preferenze per i corsi',
            'Media',
            'Status',
            'Nome materia 1',
            'Materia 1 voto 2022/23',
            'Materia 1 voto 2023/24',
            'Materia 1 voto I quadrim. 2024/25',
            'Nome materia 2',
            'Materia 2 voto 2022/23',
            'Materia 2 voto 2023/24',
            'Materia 2 voto I quadrim. 2024/25',
            'Nome materia 3',
            'Materia 3 voto 2022/23',
            'Materia 3 voto 2023/24',
            'Materia 3 voto I quadrim. 2024/25',
            'Nome materia 4',
            'Materia 4 voto 2022/23',
            'Materia 4 voto 2023/24',
            'Materia 4 voto I quadrim. 2024/25',
            'Nome materia 5',
            'Materia 5 voto 2022/23',
            'Materia 5 voto 2023/24',
            'Materia 5 voto I quadrim. 2024/25',
            'Nome materia 6',
            'Materia 6 voto 2022/23',
            'Materia 6 voto 2023/24',
            'Materia 6 voto I quadrim. 2024/25',
            'Nome materia 7',
            'Materia 7 voto 2022/23',
            'Materia 7 voto 2023/24',
            'Materia 7 voto I quadrim. 2024/25',
            'Nome materia 8',
            'Materia 8 voto 2022/23',
            'Materia 8 voto 2023/24',
            'Materia 8 voto I quadrim. 2024/25',
            'Nome materia 9',
            'Materia 9 voto 2022/23',
            'Materia 9 voto 2023/24',
            'Materia 9 voto I quadrim. 2024/25',
            'Nome materia 10',
            'Materia 10 voto 2022/23',
            'Materia 10 voto 2023/24',
            'Materia 10 voto I quadrim. 2024/25',
            'Nome materia 11',
            'Materia 11 voto 2022/23',
            'Materia 11 voto 2023/24',
            'Materia 11 voto I quadrim. 2024/25',
            'Nome materia 12',
            'Materia 12 voto 2022/23',
            'Materia 12 voto 2023/24',
            'Materia 12 voto I quadrim. 2024/25',
            'Nome materia 13',
            'Materia 13 voto 2022/23',
            'Materia 13 voto 2023/24',
            'Materia 13 voto I quadrim. 2024/25',
            'Nome materia 14',
            'Materia 14 voto 2022/23',
            'Materia 14 voto 2023/24',
            'Materia 14 voto I quadrim. 2024/25',
            'Nome materia 15',
            'Materia 15 voto 2022/23',
            'Materia 15 voto 2023/24',
            'Materia 15 voto I quadrim. 2024/25',
            'Nome materia 16',
            'Materia 16 voto 2022/23',
            'Materia 16 voto 2023/24',
            'Materia 16 voto I quadrim. 2024/25',
            'Nome materia 17',
            'Materia 17 voto 2022/23',
            'Materia 17 voto 2023/24',
            'Materia 17 voto I quadrim. 2024/25',
            'Nome materia 18',
            'Materia 18 voto 2022/23',
            'Materia 18 voto 2023/24',
            'Materia 18 voto I quadrim. 2024/25',
            'Nome materia 19',
            'Materia 19 voto 2022/23',
            'Materia 19 voto 2023/24',
            'Materia 19 voto I quadrim. 2024/25',
            'Nome materia 20',
            'Materia 20 voto 2022/23',
            'Materia 20 voto 2023/24',
            'Materia 20 voto I quadrim. 2024/25',
            'Nome materia 21',
            'Materia 21 voto 2022/23',
            'Materia 21 voto 2023/24',
            'Materia 21 voto I quadrim. 2024/25',
            'Nome materia 22',
            'Materia 22 voto 2022/23',
            'Materia 22 voto 2023/24',
            'Materia 22 voto I quadrim. 2024/25',
            'Nome materia 23',
            'Materia 23 voto 2022/23',
            'Materia 23 voto 2023/24',
            'Materia 23 voto I quadrim. 2024/25',
            'Nome materia 24',
            'Materia 24 voto 2022/23',
            'Materia 24 voto 2023/24',
            'Materia 24 voto I quadrim. 2024/25',
            'Nome materia 25',
            'Materia 25 voto 2022/23',
            'Materia 25 voto 2023/24',
            'Materia 25 voto I quadrim. 2024/25',
            'Nome materia 26',
            'Materia 26 voto 2022/23',
            'Materia 26 voto 2023/24',
            'Materia 26 voto I quadrim. 2024/25',
            'Nome materia 27',
            'Materia 27 voto 2022/23',
            'Materia 27 voto 2023/24',
            'Materia 27 voto I quadrim. 2024/25',
            'Nome materia 28',
            'Materia 28 voto 2022/23',
            'Materia 28 voto 2023/24',
            'Materia 28 voto I quadrim. 2024/25',
            'Nome materia 29',
            'Materia 29 voto 2022/23',
            'Materia 29 voto 2023/24',
            'Materia 29 voto I quadrim. 2024/25',
            'Nome materia 30',
            'Materia 30 voto 2022/23',
            'Materia 30 voto 2023/24',
            'Materia 30 voto I quadrim. 2024/25',
        ];
//        $headersType = Arr::get($this->csvSettings, 'headers', 'translate');
//
//        $methodName = 'getCsvRowHeaders' . Str::studly($headersType);
//        $headers = $this->$methodName();
        return $headers;
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
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'H' => NumberFormat::FORMAT_TEXT,
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

    protected function getCsvFieldScuolaRegioneId($value)
    {
        return $this->getFromArray($value, $this->regioni);
    }

    protected function getCsvFieldComune($value,$itemArray,$item)
    {
        if ($item->nazione_id == 1) {
            return $item->comune->nome;
        } else {
            return $item->comune_estero;
        }
    }

    protected function getCsvFieldComuneCatastale($value,$itemArray,$item)
    {
        if ($item->nazione_id == 1) {
            return $item->comune->codice_catastale;
        } else {
            return "";
        }
    }

    protected function getCsvFieldRegioneId($value)
    {
        return $this->getFromArray($value, $this->regioni);
    }

    protected function getCsvFieldNazioneId($value)
    {
        return $this->getFromArray($value, $this->nazioni);
    }

    protected function getCsvFieldProvinciaId($value)
    {
        return $this->getFromArray($value, $this->province);
    }

    protected function getCsvFieldDataNascita($value)
    {
        return Date::dateTimeToExcel(\DateTime::createFromFormat("Y-m-d",$value));
    }

    protected function getCsvFieldGen1TitoloStudioId($value)
    {
        return $this->getFromArray($value, $this->titoliStudio);
    }

    protected function getCsvFieldGen2TitoloStudioId($value)
    {
        return $this->getFromArray($value, $this->titoliStudio);
    }
//    protected function getCsvFieldProfessione1Nome($value) {
//        return $this->getFromArray($value,$this->professioni);
//    }
//    protected function getCsvFieldProfessione2Nome($value) {
//        return $this->getFromArray($value,$this->professioni);
//    }
    protected function getCsvFieldIngleseLivelloLinguisticoId($value)
    {
        return $this->getFromArray($value, $this->livelliLinguistici);
    }

    protected function getCsvFieldFranceseLivelloLinguisticoId($value)
    {
        return $this->getFromArray($value, $this->livelliLinguistici);
    }

    protected function getCsvFieldSpagnoloLivelloLinguisticoId($value)
    {
        return $this->getFromArray($value, $this->livelliLinguistici);
    }

    protected function getCsvFieldTedescoLivelloLinguisticoId($value)
    {
        return $this->getFromArray($value, $this->livelliLinguistici);
    }

    protected function getCsvFieldCineseLivelloLinguisticoId($value)
    {
        return $this->getFromArray($value, $this->livelliLinguistici);
    }

    protected function getCsvFieldStages($value)
    {
        return implode("|", array_map(function ($item) {
            return Stages::optionLabel($item);
        }, $value));
    }

    protected function getCsvFieldGareInternazionali($value)
    {
        return implode("|", array_map(function ($item) {
            return GareInternazionali::optionLabel($item);
        }, $value));
    }

    protected function getCsvFieldGareUmanistiche($value)
    {
        return implode("|", array_map(function ($item) {
            return GareUmanistiche::optionLabel($item);
        }, $value));
    }

    protected function getCsvFieldOlimpiadiMatematica($value)
    {
        return OlimpiadiMatematica::optionLabel($value);
    }

    protected function getCsvFieldOlimpiadiMatematicaSquadre($value)
    {
        return OlimpiadiMatematicaSquadre::optionLabel($value);
    }

    protected function getCsvFieldOlimpiadiMatematicaSquadreFemminili($value)
    {
        return OlimpiadiMatematicaSquadreFemminili::optionLabel($value);
    }

    protected function getCsvFieldOlimpiadiFisica($value)
    {
        return OlimpiadiFisica::optionLabel($value);
    }

    protected function getCsvFieldOlimpiadiFisicaSquadreMiste($value)
    {
        return OlimpiadiFisicaSquadreMiste::optionLabel($value);
    }

    protected function getCsvFieldOlimpiadiScienzeNaturali($value)
    {
        return OlimpiadiScienzeNaturali::optionLabel($value);
    }

    protected function getCsvFieldGiochiChimica($value)
    {
        return GiochiChimica::optionLabel($value);
    }

    protected function getCsvFieldOlimpiadiInformatica($value)
    {
        return OlimpiadiInformatica::optionLabel($value);
    }

    protected function getFromArray($value, $array = [], $default = 'N.D.')
    {
        if (!is_int($value)) {
            return $default;
        }
        return Arr::get($array, $value, $default);
    }

    protected function getCsvFieldCorsi($value,$itemArray,$item)
    {
        $corsi = $item->corsi->pluck('titolo')->all();

        return implode(";",$corsi);

    }

    protected function getCsvFieldVoti($value,$itemArray,$item)
    {
        $voti = $item->voti;
        $votiArray = [];
        foreach ($voti as $voto) {
            $votiArray[] = $this->getFromArray($voto->materia_id,$this->materie);
            $votiArray[] = $voto->voto_anno_2;
            $votiArray[] = $voto->voto_anno_1;
            $votiArray[] = $voto->voto_primo_quadrimestre;
        }

        Log::info("VOTIIII:::",$votiArray);

        return $votiArray;
    }

    protected function getCsvFieldScuolaBiennio($value) {
        return "";
    }

//
//    protected function getCsvFieldTelefono($value) {
//
//        return "Tel: " . $value;
//
//    }
//
//    protected function getCsvFieldCellulare($value) {
//
//        return "Cell: " . $value;
//
//    }
//
//    protected function getCsvFieldCapResidenza($value) {
//
//        return "Cap: " . $value;
//
//    }

}
