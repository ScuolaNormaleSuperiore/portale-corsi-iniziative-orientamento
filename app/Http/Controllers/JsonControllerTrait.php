<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;

trait JsonControllerTrait
{

    protected $json = [
        'error' => 0,
        'msg' => '',
        'result' => null,
    ];


    protected function _error($msg,$additionalData = [],$status = 200,$exit = false)
    {
        $this->json['error'] = 1;
        $this->json['msg'] = $msg;
        foreach ($additionalData as $field => $value) {
            $this->json[$field] = $value;
        }
        if ($exit) {
            return $this->_json(false,$status);
        }
    }

    protected function _errorAndExit($msg,$status = 200)
    {
        return $this->_error($msg,[],$status,true);
    }

    protected function _errorWithResult($msg,$result,$status = 200,$exit = false)
    {
        return $this->_error($msg,['result' => $result],$status,$exit);
    }

    protected function _json($msg = false, $status = 200)
    {
        if ($msg !== false) {
            $this->json['msg'] = $msg;
        }
        return Response::json($this->json,$status);
    }

    protected function _result($result,$msg = null,$exit = true) {
        $this->json['result'] = $result;
        if ($exit) {
            return $this->_json($msg);
        }
    }

}
