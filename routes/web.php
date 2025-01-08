<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\FEController;
use App\Http\Controllers\CandidatureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('json/dynamic-conf', [JsonController::class,'postDynamicConf'])->name('json-dynamic-conf');
Route::post('json/user-info', [JsonController::class,'getUserInfo'])->name('json-user-info');

//Route::get('test', [\App\Http\Controllers\TestController::class,'test'])->name('test');
//Route::get('testn', [\App\Http\Controllers\TestController::class,'newsletter'])->name('testn');

Route::get('/', [FEController::class,'index'])->name('fe-index')->middleware([]);
Route::get('/orientamento', [FEController::class,'orientamento'])->name('orientamento')->middleware([]);
Route::get('/pagina-orientamento/{pagina}', [FEController::class,'paginaOrientamento'])->name('pagina-orientamento')->middleware([]);
Route::get('/pagina/{pagina}', [FEController::class,'pagina'])->name('pagina')->middleware([]);
Route::get('/sportello-studenti', [FEController::class,'sportelloStudenti'])->name('sportello-studenti')->middleware([]);
Route::get('/sportello-studenti/{classe}', [FEController::class,'sportelloStudentiClasse'])->name('sportello-studenti-classe')->middleware([]);
Route::get('/archivio-news', [FEController::class,'archivioNews'])->name('archivio-news')->middleware([]);
Route::get('/dettaglio-news/{notizia}', [FEController::class,'dettaglioNews'])->name('dettaglio-news')->middleware([]);
Route::get('/archivio-eventi', [FEController::class,'archivioEventi'])->name('archivio-eventi')->middleware([]);
Route::get('/dettaglio-evento/{evento}', [FEController::class,'dettaglioEvento'])->name('dettaglio-evento')->middleware([]);

Route::get('/cortesia-scuola-richiesta', [FEController::class,'scuolaRichiestaCortesia'])->name('cortesia-scuola-richiesta')->middleware([]);

Route::group([
    'middleware' => ['auth','verified']
], function () {
    Route::get('/candidature', [CandidatureController::class, 'index'])->name('candidature');
    Route::get('/candidatura/{iniziativa}/new', [CandidatureController::class, 'create'])->name('candidatura.new');
    Route::get('/candidatura/edit/{candidatura}/{step?}', [CandidatureController::class, 'edit'])->name('candidatura.edit');
    Route::post('/candidatura/{iniziativa}/new', [CandidatureController::class, 'store'])->name('candidatura.store');
    Route::put('/candidatura/edit/{candidatura}/{step?}', [CandidatureController::class, 'update'])->name('candidatura.update');
    Route::get('/candidatura/view/{candidatura}', [CandidatureController::class, 'view'])->name('candidatura.view');
});

Route::get('/archivio-video', [FEController::class,'archivioVideo'])->name('archivio-video')->middleware([]);

Route::get('/bladepuro', function () {
    return view('bladepuro');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','role:Superutente'])->name('dashboard');

Route::get('/vue-sfc', function () {
    return view('vue-sfc');
})->middleware(['auth'])->name('vue-sfc');

Route::get('/va', function () {
    return view('vueapp');
})->middleware(['auth'])->name('vueapp');

Route::get('/sakai', function () {
    return view('sakai');
})->middleware(['auth'])->name('sakai');


Route::group(["middleware" => ["auth","verified"]], function() {
    Route::get("profile", [UserController::class, 'getProfile'])->name('user.profile');
    Route::post("profile", [UserController::class, 'postProfile'])->name('user.profile-update');
});

Route::group(['prefix' => 'crud', 'as' => 'crud'], function () {
    Route::get('page/{page}', [MiscController::class,'crudPage'])->name('crud.page');
});

Route::group([
    'middleware' => []
], function () {

// route to access template applied image file
    Route::get('imagecache/{template}/{filename}', [\Intervention\Image\ImageCacheController::class, 'getResponse'])
        ->where(['filename' => '[ \w\\.\\/\\-\\@\(\)]+'])
        ->name('imagecache');

    Route::get('viewmediable/{model}/{pk}/{template?}', [\App\Http\Controllers\Api\DownloadController::class, 'viewMediableFile']);
//    Route::get('viewmediable/{model}/{pk}/{template?}', function ($model, $pk, $template = null) {
//        return $model;
//    });


});

//Route::get('logout', 'Auth\LoginController@logout')->name('get-logout');

require __DIR__.'/auth.php';

require __DIR__.'/foorm.php';
