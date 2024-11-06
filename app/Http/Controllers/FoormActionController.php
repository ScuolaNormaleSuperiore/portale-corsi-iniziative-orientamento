<?php
/**
 * Created by PhpStorm.
 * User: pier
 * Date: 29/01/2019
 * Time: 16:04
 */

namespace App\Http\Controllers;

use Gecche\Foorm\Facades\Foorm;
use Illuminate\Support\Facades\Response;

class FoormActionController extends Controller
{
    protected $foorm;

    protected $foormAction;

    protected $foormManager;

    protected $json = [
        'error' => 0,
        'msg' => '',
    ];


    public function postSet($foormName, $foormType, $pk = null)
    {
        $params = $pk ? ['id' => $pk] : [];
        $this->buildAndGetFoormActionResult('set', $foormName, $foormType, $params);
        return $this->_json();
    }

    public function delete($foormName, $foormType, $pk = null)
    {
        $params = $pk ? ['id' => $pk] : [];
        $this->buildAndGetFoormActionResult('delete', $foormName, $foormType, $params);
        return $this->_json();
    }

    public function postMultiDelete($foormName, $foormType, $pk = null)
    {
        $params = $pk ? ['id' => $pk] : [];
        $this->buildAndGetFoormActionResult('multi-delete', $foormName, $foormType, $params);
        return $this->_json();
    }

    public function postAutocomplete($foormName, $foormType, $pk = null)
    {
        $params = $pk ? ['id' => $pk] : [];
        $this->buildAndGetFoormActionResult('autocomplete', $foormName, $foormType, $params);
        return $this->_json();
    }

    public function postUploadfile($foormName, $foormType, $pk = null)
    {
        $params = $pk ? ['id' => $pk] : [];
        $this->buildAndGetFoormActionResult('uploadfile', $foormName, $foormType, $params);
        return $this->_json();
    }

    public function postCsvExport($foormName, $foormType, $pk = null)
    {
        $params = $pk ? ['id' => $pk] : [];
        $this->buildAndGetFoormActionResult('csv-export', $foormName, $foormType, $params);
        return $this->_json();
    }

    protected function buildAndGetFoormActionResult($action, $foormName, $foormType, $params)
    {

        try {
            $this->buildFoormAction($action, $foormName, $foormType, $params);
            $this->getFoormActionResult();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
    }


    protected function buildFoormAction($action, $foormName, $foormType, $params)
    {
        $this->foormAction = Foorm::getFoormAction($action, "$foormName.$foormType", request(), $params);
    }

    protected function getFoormActionResult()
    {

        $this->foormAction->validateAction();
        $this->json['result'] = $this->foormAction->performAction();

    }


    protected function _error($msg)
    {
        $this->json['error'] = 1;
        $this->json['msg'] = $msg;
    }

    protected function _json()
    {
        return Response::json($this->json);
    }
}
