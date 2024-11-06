<?php
/**
 * Created by PhpStorm.
 * User: pier
 * Date: 29/01/2019
 * Time: 16:04
 */

namespace App\Http\Controllers;

use App\Services\UploadService;

use Gecche\Foorm\Facades\Foorm;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Lang;
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

    public function getSearch($foormName, $type = 'search')
    {
        $this->buildAndGetFoormResult($foormName, $type);
        return $this->_json();
    }

    public function getList($foormName, $type = 'list')
    {
        $this->buildAndGetFoormResult($foormName, $type);
        return $this->_json();
    }

    public function getNew($foormName, $type = 'insert')
    {
        $this->buildAndGetFoormResult($foormName, $type);
        return $this->_json();
    }

    public function postCreate($foormName, $type = 'insert')
    {
        $this->buildAndGetFoormResult($foormName, $type, null, [], ['save']);
        return $this->_json();
    }


    public function getEdit($foormName, $pk, $type = 'edit')
    {
        $this->buildAndGetFoormResult($foormName, $type, $pk);
        return $this->_json();

    }

    public function postUpdate($foormName, $pk, $type = 'edit')
    {
        $this->buildAndGetFoormResult($foormName, $type, $pk, [], ['save']);
        return $this->_json();
    }

    public function getShow($foormName, $pk, $type = 'view')
    {
        $this->buildAndGetFoormResult($foormName, $type, $pk, []);
        return $this->_json();
    }

    /*
     * CONSTRAINTS METHOD
     */

    public function getListConstrained($foormName, $constraintField, $constraintValue, $type = 'list')
    {
        $params = $this->prepareFixedConstraints($constraintField, $constraintValue);
        $this->buildAndGetFoormResult($foormName, $type, null, $params);
        return $this->_json();
    }

    public function getSearchConstrained($foormName, $constraintField, $constraintValue, $type = 'search')
    {
        $params = $this->prepareFixedConstraints($constraintField, $constraintValue);
        $this->buildAndGetFoormResult($foormName, $type, null, $params);
        return $this->_json();
    }

    public function getNewConstrained($foormName, $constraintField, $constraintValue, $type = 'insert')
    {
        $params = $this->prepareFixedConstraints($constraintField, $constraintValue);
        $this->buildAndGetFoormResult($foormName, $type, null, $params);
        return $this->_json();
    }

    public function postCreateConstrained($foormName, $constraintField, $constraintValue, $type = 'insert')
    {
        $params = $this->prepareFixedConstraints($constraintField, $constraintValue);
        $this->buildAndGetFoormResult($foormName, $type, null, $params, ['save']);
        return $this->_json();
    }

    public function getEditConstrained($foormName, $pk, $constraintField, $constraintValue, $type = 'edit')
    {
        $params = $this->prepareFixedConstraints($constraintField, $constraintValue);
        $this->buildAndGetFoormResult($foormName, $type, $pk, $params);
        return $this->_json();
    }

    public function postUpdateConstrained($foormName, $pk, $constraintField, $constraintValue, $type = 'edit')
    {
        $params = $this->prepareFixedConstraints($constraintField, $constraintValue);
        $this->buildAndGetFoormResult($foormName, $type, $pk, $params, ['save']);
        return $this->_json();
    }

    public function getShowConstrained($foormName, $pk, $constraintField, $constraintValue, $type = 'view')
    {
        $params = $this->prepareFixedConstraints($constraintField, $constraintValue);
        $this->buildAndGetFoormResult($foormName, $type, $pk, $params);
        return $this->_json();
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

    protected function _json()
    {
        return Response::json($this->json);
    }

    protected function prepareFixedConstraints($constraintField, $constraintValue)
    {
        return [
            'fixed_constraints' => [
                [
                    'field' => $constraintField,
                    'value' => $constraintValue,
                ],
            ]
        ];
    }

    protected function buildAndGetFoormResult($foormName, $type, $pk = null, $params = [], $furtherActions = [])
    {

        try {
            if ($pk) {
                $params['id'] = $pk;
            }
            $this->buildFoorm($foormName, $type, $params);
            $this->foormAuthorization($pk);
            $this->performFurtherActionsOnFoorm($furtherActions);
            $this->getFoormResult();
            $this->addExtrasToResult();
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

    protected function foormAuthorization($pk) {
        $foormType = Foorm::getNormalizedFoormType();

        $foormModelNameForPermissions = Str::snake(Foorm::getRelativeModelName());


        $ability = $foormType;
        $authorizationArguments = $pk ? $this->foorm->getModel() : Foorm::getFullModelName();



        switch ($foormType) {
            case 'search':
            case 'list':
                $ability = 'listing';
                break;
            case 'edit':
                $ability = 'update';
                break;
            case 'insert':
                $ability = 'create';
                break;
            default:
                break;
        }


        $user = Auth::user();

        if (!$user) {
            throw UnauthorizedException::notLoggedIn();
        }
        $permission = $ability . ' ' . $foormModelNameForPermissions;

        if (!$user->can($ability,$authorizationArguments)) {
            throw UnauthorizedException::forPermissions([$permission]);
        };



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

        $this->json['result'] = $this->foorm->getFormData();
        $this->json['metadata'] = $this->foorm->getFormMetadata();

    }

    /*
     * QUESTA VA VISTA E SE E COME SPOSTARLA NELLE ACTIONS O ADDIRITTURA FUORI DA QUI
     */

    public function uploadfile()
    {
        try {
            $type = Request::get("resource_type", "foto");

            $uploadService = UploadService::getInstance();

            $uploadService->validate($type, Request::all());

            //PASSO LA VALIDAZIONE


            $file = Request::file('file');

            $tempFileArray = $uploadService->saveTempFile($type, $file);


            // $temp_array = array_merge($temp_array, array_intersect_key(Request::all(), $temp_array));
            $this->json['msg'] = Lang::get('app.upload_success');
            $this->json['result'] = $tempFileArray;
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
            $this->json['result'] = [];
        }
        return $this->_json();
    }

    protected function addExtrasToResult() {
        $role = Auth::id() ? Auth::user()->mainrole->name : null;
        $this->json['app'] = [
            'auth' => [
                'id' => Auth::id(),
                'role' => $role,
                'isAdmin' => in_array($role,['Superutente','Superadmin','Admin']),
            ]
        ];
    }
}
