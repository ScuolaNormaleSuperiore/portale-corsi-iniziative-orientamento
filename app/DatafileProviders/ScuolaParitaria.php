<?php

namespace App\DatafileProviders;

use App\Foorm\AssociatedUserTrait;
use App\Models\Anno;
use App\Models\Annoaccademicostudente;
use App\Models\Categoriaaccademica;
use App\Models\ContoTipologia;
use App\Models\CupGeoArea;
use App\Models\CupGeoNazione;
use App\Models\CupGeoProvincia;
use App\Models\CupGeoRegione;

use App\Models\Provincia;
use App\Models\User;
use App\Services\Constants;
use App\Services\FormatValues;
use Carbon\Carbon;
use Gecche\Cupparis\AppVars\Facades\AppVars;
use Gecche\Cupparis\Datafile\Breeze\BreezeDatafileProvider;
use Gecche\Cupparis\Datafile\Breeze\Contracts\BreezeDatafileInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ScuolaParitaria extends BreezeDatafileProvider
{

    /*
     * array del tipo di datafile, ha la seguente forma: array( 'headers' => array( 'header1' => array( 'datatype' => 'string|int|data...', (default string) 'checks' => array( 'checkCallback1' => array(params => paramsArray,type => error|alert), ... 'checkCallbackN' => array(params => paramsArray,type => error|alert), ), (deafult array()) 'transforms' => array( 'transformCallback1' => array(params), ... 'transformCallbackN' => array(params), ), (default array()) 'blocking' => true|false (default false) ) ... 'headerN' => array( 'datatype' => 'string|int|data...', (default string) 'checks' => array( 'checkCallback1' => array(params), ... 'checkCallbackN' => array(params), ), (deafult array()) 'transforms' => array( 'transformCallback1' => array(params), ... 'transformCallbackN' => array(params), ), (default array()) ) 'peremesso' => 'permesso_string' (default 'datafile_upload') 'blocking' => true|false (default false) ) ) I chechCallbacks e transformCallbacks sono dei nomi di funzioni di questo modello (o sottoclassi) dichiarati come protected e con il nome del callback preceduto da _check_ o _transform_ e che accettano i parametri specificati I checkCallbacks hanno anche un campo che specifica se si tratta di errore o di alert I checks servono per verificare se i dati del campo corrispondono ai requisiti richiesti I transforms trasformano i dati in qualcos'altro (es: formato della data da gg/mm/yyyy a yyyy-mm-gg) Vengono eseguiti prima tutti i checks e poi tutti i transforms (nell'ordine specificato dall'array) Blocking invece definisce se un errore nei check di una riga corrisponde al blocco dell'upload datafile o se si può andare avanti saltando quella riga permesso è se il
     */

    protected $comuni;
    protected $province;
    protected $provinceRegioni;

    protected $modelDatafileName = \App\DatafileModels\Scuola::class;
    protected $modelTargetName = \App\Models\Scuola::class;

    protected $zip = false;
    protected $zipDir = false;
    protected $zipDirName = '';

    protected $chunkRows = 1000;
    protected $fileProperties = [
//        'skipEmptyLines' => true,  // Se la procedura salta le righe vuote che trova
//        'stopAtEmptyLine' => true, // Se la procedura di importazione si ferma alla prima riga vuota incontrata
//        'startingColumn' => 'A',
//        'endingColumn' => 'J',
//        'sheetName' => 'Caps',
    ];
//    protected $filetype = 'excel'; //csv, fixed_text, excel
    protected $filetype = 'csv'; //csv, fixed_text, excel

    protected $separator = ';';

    protected $excludeFromFormat = [
        'id',
        'row',
        'datafile_id',
        'datafile_sheet',

    ];

    /*
     * HEADERS array header => datatype
     */
    public $headers = array(
        'ANNOSCOLASTICO',
        'AREAGEOGRAFICA',
        'REGIONE',
        'PROVINCIA',

        'CODICESCUOLA',
        'DENOMINAZIONESCUOLA',
        'INDIRIZZOSCUOLA',
        'CAPSCUOLA',
        'CODICECOMUNESCUOLA',
        'DESCRIZIONECOMUNE',

        'DESCRIZIONETIPOLOGIAGRADOISTRUZIONESCUOLA',

        'INDIRIZZOEMAILSCUOLA',
        'INDIRIZZOPECSCUOLA',
        'SITOWEBSCUOLA',

    );

    public function __construct()
    {
        parent::__construct();

        $province = Provincia::all();
        $this->province = $province->pluck('nome', 'id')->all();
        $this->provinceRegioni = $province->pluck('regione_id', 'id')->all();

        $this->province = array_flip(array_map('strtolower', $this->province));

        $this->comuni = DB::table('comuni')->select(['id','codice_catastale'])
            ->get()->pluck('id','codice_catastale')->all();

    }


    public
    function formatDatafileRow($row)
    {


        $newRow = [];
        foreach ($this->headers as $header) {
            $newRow[$header] = Arr::get($row, $header, null);
        }


        $newRow['provincia_id'] = Arr::get($this->province, strtolower($newRow['PROVINCIA']));


        $row = $newRow;

        return $row;
    }


    protected function getAnno(BreezeDatafileInterface $modelDatafile) {
        return intval(substr(trim($modelDatafile->ANNOSCOLASTICO),0,4));
    }

    public function associateRow(BreezeDatafileInterface $modelDatafile)
    {
//        $anno = $this->getAnno($modelDatafile);

        $codice = trim($modelDatafile->CODICESCUOLA);

        return \App\Models\Scuola::where('codice',$codice)->firstOrNew();

    }

    public function formatRow(BreezeDatafileInterface $modelDatafile, Model $modelTarget = null)
    {
        $directFields = [
            'provincia_id' => 'provincia_id',

            'AREAGEOGRAFICA' => 'area_geografica',

            'CODICESCUOLA' => 'codice',
            'DENOMINAZIONESCUOLA' => 'denominazione',
            'INDIRIZZOSCUOLA' => 'indirizzo',
            'CAPSCUOLA' => 'cap',
            'CODICECOMUNESCUOLA' => 'catastale_comune',
            'DESCRIZIONECOMUNE' => 'comune',

            'DESCRIZIONETIPOLOGIAGRADOISTRUZIONESCUOLA' => 'tipologia_grado_istruzione',
        ];

        foreach ($directFields as $origField => $destField) {
            $values[$destField] = trim($modelDatafile->$origField);
        }

        $ndFields = [
            'INDIRIZZOEMAILSCUOLA' => 'email',
            'INDIRIZZOPECSCUOLA' => 'pec',
            'SITOWEBSCUOLA' => 'web',
        ];

        foreach ($ndFields as $origField => $destField) {
            $origValue = trim($modelDatafile->$origField);
            $values[$destField] = strtolower($origValue) == 'non disponibile' ? null : $origValue;
        }
//            'SEDESCOLASTICA' => 'sedescolastica',
//            'INDICAZIONESEDEDIRETTIVO' => 'indicazionesededirettivo',

        $booleanFields = [

        ];

        foreach ($booleanFields as $origField => $destField) {
            $origValue = trim($modelDatafile->$origField);
            $values[$destField] = strtolower($origValue) == 'si' ? 1 : 0;
        }

//        $values['email_riferimento'] = $values['email'];
//        $user = User::where('email',$values['email'])->first();
//        if ($user) {
//            $values['user_id'] = $user->getKey();
//        }

        $values['anno'] = $this->getAnno($modelDatafile);

        $values['info'] = $modelTarget->addAnnoToInfo(trim($modelDatafile->ANNOSCOLASTICO));


        $values['comune_id'] = Arr::get($this->comuni,$values['catastale_comune']);
        $values['regione_id'] = Arr::get($this->provinceRegioni,$values['provincia_id']);

        $values['tipo'] = 'paritaria';
        return $values;
    }



//
//
}

// End Datafile Core Model
