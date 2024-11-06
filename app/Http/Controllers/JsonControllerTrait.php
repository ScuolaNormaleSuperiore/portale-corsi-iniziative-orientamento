<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

trait JsonControllerTrait
{

    protected $json = [
        'error' => 0,
        'msg' => '',
        'result' => null,
    ];


    protected function _error($msg,$additionalData = [],$exit = false)
    {
        $this->json['error'] = 1;
        $this->json['msg'] = $msg;
        foreach ($additionalData as $field => $value) {
            $this->json[$field] = $value;
        }
        if ($exit) {
            return $this->_json();
        }
    }

    protected function _errorAndExit($msg)
    {
        return $this->_error($msg,[],true);
    }

    protected function _errorWithResult($msg,$result,$exit = false)
    {
        return $this->_error($msg,['result' => $result],$exit);
    }

    protected function _json($msg = false)
    {
        if ($msg !== false) {
            $this->json['msg'] = $msg;
        }
        return Response::json($this->json);
    }

    protected function _result($result,$msg = null,$exit = true) {
        $this->json['result'] = $result;
        if ($exit) {
            return $this->_json($msg);
        }
    }

}
