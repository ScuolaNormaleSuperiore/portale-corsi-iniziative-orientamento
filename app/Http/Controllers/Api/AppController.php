<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\JsonControllerTrait;
use App\Models\Corso;
use App\Models\Iniziativa;
use App\Models\Scuola;
use Egulias\EmailValidator\Result\ValidEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AppController extends Controller
{

    use JsonControllerTrait;
    public function getIniziativaCorsi(Iniziativa $iniziativa) {

        $corso = new Corso();

        $corsiList = $corso->getForSelectList($corso->where('iniziativa_id',$iniziativa->getKey()));

        $result = [
            'options' => $corsiList,
            'options_order' => array_keys($corsiList),
        ];

        return $this->_result($result);
    }

    public function getScuoleAutocomplete(Request $request) {


        $nItems = $request->get('nItems',10);

        $value = $request->get('value');

        $searchFields = ['denominazione'];
        $resultFields = ['denominazione','codice','email_riferimento'];
        $appends = ['provincia_sigla'];


        $autocompleteResult = Scuola::autoComplete($value,$searchFields,$resultFields,$nItems,null,$appends);

//        $options = [];
//        foreach ($autocompleteResult as $scuola) {
//            $options[$scuola['id']] = $scuola['denominazione'] . ' (' . $scuola['provincia_sigla'] . ') - Cod:' . $scuola['codice'];
//        }

        $result = $autocompleteResult;

        return $this->_result($result);
    }

    public function newsletterAdd(Request $request) {

        $email = $request->get('email');

        if (!$this->validate($request,['email'=>'email'])) {
            return $this->_error("Indirizzo email non valido",400);
        }

        return $this->_result(null);

    }

}
