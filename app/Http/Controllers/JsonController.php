<?php
/**
 * Created by PhpStorm.
 * User: pier
 * Date: 29/01/2019
 * Time: 16:04
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class JsonController extends Controller
{

    use JsonControllerTrait;

    public function postDynamicConf() {
        $conf = [];
        $conf['appName'] = env('APP_NAME','Laravel');
        $this->json['result'] = $conf;
        return $this->_json();
    }

    public function getLoginInfo() {
        $user = Auth::user();
        if ($user) {
            $this->json['result'] = $user->toArray();
            return $this->_json();
        }
        return $this->_error('user non logged');
    }
}
