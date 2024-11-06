<?php

namespace App\Http\Controllers;

use App\DatafileProviders\ComuneIstat;
use App\Jobs\ProcessTest;
use App\User;
use Carbon\Carbon;
use Gecche\Cupparis\AssetTime\Facades\AssetTime;
use Gecche\Cupparis\Datafile\Breeze\BreezeDatafile;
use Gecche\Cupparis\Menus\Facades\Menus;
use Gecche\Cupparis\Queue\Facades\CupparisQueue;
use Gecche\DBHelper\Facades\DBHelper;
use Gecche\Foorm\Facades\Foorm;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageCacheController;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test() {

    }

}
