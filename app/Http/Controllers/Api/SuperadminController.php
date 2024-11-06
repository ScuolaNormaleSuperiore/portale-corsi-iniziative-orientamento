<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class SuperadminController extends Controller
{

    public function getModels() {
        $models = Config::get('cupparis-app.foorm.entities',[]);
        $asModels = [];
        foreach ($models as $model) {
            $asModels[] = [
                'id' => $model,
                'label' => $model,
            ];
        }
        $json = [
            'models' => $asModels,
            'permessi' => ['list','edit','create','view','delete']
        ];
        return response()->json($json);
    }
}
