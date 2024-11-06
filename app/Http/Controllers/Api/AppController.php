<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\JsonControllerTrait;
use App\Models\Corso;
use App\Models\Iniziativa;

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

}
