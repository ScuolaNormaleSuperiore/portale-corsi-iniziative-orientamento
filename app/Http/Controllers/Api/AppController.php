<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\JsonControllerTrait;
use App\Models\Corso;
use App\Models\Iniziativa;
use Egulias\EmailValidator\Result\ValidEmail;
use Illuminate\Http\Request;

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

    public function newsletterAdd(Request $request) {

        $email = $request->get('email');

        if (!$this->validate($request,['email'=>'email'])) {
            return $this->_error("Indirizzo email non valido",400);
        }

        return $this->_result(null);

    }

}
