<?php

namespace App\Http\Controllers\ExternalApi;

use App\Http\Controllers\Api\Controller;
use Gecche\Foorm\Facades\Foorm;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;

class FoormController extends Controller
{
    protected $foorm;

    protected $json = [
        'error' => 0,
        'msg' => '',
    ];

    protected function _json()
    {
        return Response::json($this->json);
    }

    protected function _error($msg)
    {
        $this->json['error'] = 1;
        if (Config::get('cupparis-app.array_to_string',false) && is_array($msg)) {
            $separator = Config::get('cupparis-app.separator','<br/>');
            $stringMsg = "";
            $msg = Arr::flatten($msg);
            foreach ($msg as $line) {
                $stringMsg .= $line . $separator;
            }
            $stringMsg = substr($stringMsg,0,-(strlen($separator)));
            $this->json['msg'] = $stringMsg;
        } else {
            $this->json['msg'] = $msg;
        }

    }

    public function candidatoList(Request $request)
    {
        $searchFields = array_filter($request->only(['s_nome','s_cognome','s_data_nascita']));
//        if (count($searchFields) < 3) {
//            $this->_error("Cognome, Nome e Data di nascita sono obbligatori");
//            return $this->_json();
//        }
//        foreach ($searchFields as $searchField => $value) {
//            if (!$value) {
//                $this->_error("Cognome, Nome e Data di nascita sono obbligatori");
//                return $this->_json();
//            }
//        }
        $this->buildAndGetFoormResult('api_candidato', 'list');
        return $this->_json();
    }

    protected function buildAndGetFoormResult($foormName, $type, $pk = null, $params = [], $furtherActions = [])
    {

        try {
            if ($pk) {
                $params['id'] = $pk;
            }
            $this->buildFoorm($foormName, $type, $params);
            $this->performFurtherActionsOnFoorm($furtherActions);
            $this->getFoormResult();
        } catch (ValidationException $e) {
            $this->_error($e->errors());
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
    }

    protected function buildFoorm($foormName, $type, $params)
    {
        $this->foorm = Foorm::getFoorm("$foormName.$type", request(), $params);
    }



    protected function performFurtherActionsOnFoorm($furtherActions = []) {
        foreach ($furtherActions as $action) {
            if (method_exists($this->foorm,$action)) {
                $this->foorm->$action();
            }
        }
    }

    protected function getFoormResult()
    {

        $data = $this->foorm->getFormData();
        Log::info("DATA");
        Log::info($data);
        $this->json['result'] = Arr::get($data,'data',$data);
        //$this->json['metadata'] = $this->foorm->getFormMetadata();

    }
}
