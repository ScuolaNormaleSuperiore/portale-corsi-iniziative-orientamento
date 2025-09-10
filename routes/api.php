<?php

use App\Http\Controllers\Api\FoormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\DownloadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/ext/login',  [\App\Http\Controllers\ExternalApi\LoginController::class, 'login']);
Route::group([
    'prefix' => 'ext',
    'middleware' => []
], function () {
    Route::post('candidato', [\App\Http\Controllers\ExternalApi\FoormController::class,'candidatoList']);
});

Route::post('/login',  [LoginController::class, 'login']);
Route::post('/newsletter/add',  [\App\Http\Controllers\Api\AppController::class, 'newsletterAdd'])->name('newsletter-add');

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user()->toJson();
});
Route::middleware('auth:sanctum')->get('/app-menu',[FoormController::class,'getAppMenu']);

Route::any('/logout', [LoginController::class, 'logout'])
                ->middleware('auth:sanctum')
                ->name('logout');

$namespace = \Illuminate\Support\Facades\Config::get('cupparis-app.namespace',"Gecche\\Cupparis\\App\\Http\\Controllers");

Route::group([
    'middleware' => []
], function () {

    Route::get('imagecache/{template}/{filename}',function() {
        echo "pippo";
    });
// route to access template applied image file
    Route::get('imagecache/{template}/{filename}', [\Intervention\Image\ImageCacheController::class, 'getResponse'])
        ->where(['filename' => '[ \w\\.\\/\\-\\@\(\)]+'])
        ->name('imagecache');

    Route::get('viewmediable/{model}/{pk}/{template?}', [DownloadController::class, 'viewMediableFile']);
//    Route::get('viewmediable/{model}/{pk}/{template?}', function ($model, $pk, $template = null) {
//        return $model;
//    });


});

Route::group([
    'namespace' => $namespace,
    'middleware' => ['auth:sanctum']
], function () {

// route to access template applied image file
    Route::get('imagecache/{template}/{filename}', [
        'uses' => '\Intervention\Image\ImageCacheController@getResponse',
        'as' => 'imagecache'
    ])->where(['filename' => '[ \w\\.\\/\\-\\@\(\)]+']);

    // Route::get('viewmediable/{model}/{pk}/{template?}', [DownloadController::class, 'viewMediableFile']);
    Route::get('viewmediable/{model}/{pk}/{template?}', function($model,$pk,$template=null) {
        return $model;
    });

    Route::get('downloadtemp/{nome}', [DownloadController::class, 'downloadtemp']);
    Route::get('downloadmediable/{model}/{pk}', [DownloadController::class, 'downloadMediableFile']);
    Route::get('openmediable/{model}/{pk}', [DownloadController::class, 'openMediableFile']);

    Route::get('viewuploadable/{filename}/{template?}', [DownloadController::class, 'viewUploadableFile']);
    Route::get('downloaduploadable/{filename}/{disposition?}', [DownloadController::class, 'downloadUploadableFile']);

    Route::get('downloadrelation/{model}/{pk}/{relation?}', [DownloadController::class, 'downloadRelation']);

});

Route::get('/iniziativa-corsi/{iniziativa}',[\App\Http\Controllers\Api\AppController::class,'getIniziativaCorsi'])->name('iniziativa-corsi');
Route::post('/scuole-suggest',[\App\Http\Controllers\Api\AppController::class,'getScuoleAutocomplete'])->name('scuole-suggest');
Route::post('/comuni-provincia',[\App\Http\Controllers\Api\AppController::class,'getComuniProvincia'])->name('comuni-provincia');


require __DIR__ . '/api-foorm.php';
require __DIR__ . '/api-queue.php';
require __DIR__ . '/api-superadmin.php';
