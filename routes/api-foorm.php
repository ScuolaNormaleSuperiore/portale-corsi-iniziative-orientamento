<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoormController;
use App\Http\Controllers\FoormActionController;
use App\Http\Controllers\JsonController;

Route::get('json/dynamic-conf', [JsonController::class,'postDynamicConf'])->name('json-dynamic-conf');
Route::post('json/user-info', [JsonController::class,'getUserInfo'])->name('json-user-info');

Route::middleware('auth:sanctum')->post('uploadfile', [FoormController::class,'uploadfile']);

Route::group(['prefix' => 'foormaction','middleware' => 'auth:sanctum'], function () {
    $whereFoorm = join("|", \Gecche\Cupparis\App\Facades\Cupparis::get('foorm.entities'));

    //PARAMETRI DA METTERE IN POST: id
    Route::delete('delete/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'delete'])->where([
        'foorm' => $whereFoorm
    ]);

    //PARAMETRI DA METTERE IN POST: ids (array)
    Route::post('multi-delete/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postMultiDelete'])->where([
        'foorm' => $whereFoorm
    ]);
    //PARAMETRI DA METTERE IN POST: field, value
    Route::post('set/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postSet'])->where([
        'foorm' => $whereFoorm
    ]);
    //PARAMETRI DA METTERE IN POST: field, value. opzionali: n_items
    //Il campo field (nel caso di autocomplete su un campo di una relazione è della forma relation|field
    Route::post('autocomplete/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postAutocomplete'])->where([
        'foorm' => $whereFoorm
    ]);
    //PARAMETRI DA METTERE IN POST: field (es: attachment|resource)
    Route::post('uploadfile/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postUploadfile'])->where([
        'foorm' => $whereFoorm
    ]);
    //PARAMETRI DA METTERE IN POST: csvType (opzionale: 'default')
    //DA DEFINIRE
    Route::post('csv-export/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postCsvExport'])->where([
        'foorm' => $whereFoorm
    ]);
    Route::post('pdf-export/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postPdfExport'])->where([
        'foorm' => $whereFoorm
    ]);
    Route::post('split-tables/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postSplitTables'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::post('elastic-json/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postElasticJson'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::post('xls-export/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postXlsExport'])->where([
        'foorm' => $whereFoorm
    ]);
    Route::post('media-download/{foorm}/{foormtype}/{foormpk}', [FoormActionController::class,'postMediaDownload'])->where([
        'foorm' => $whereFoorm
    ]);
});


Route::group(['prefix' => 'foormcaction','middleware' => 'auth:sanctum'], function () {
    $whereFoorm = join("|", \Gecche\Cupparis\App\Facades\Cupparis::get('foorm.entities'));

    Route::post('flush-datafile/{foorm}/{foormtype}/{constraintField}/{constraintValue}', [FoormActionController::class,'flushDatafileConstrained'])->where([
        'foorm' => $whereFoorm
    ]);

//    Route::delete('delete/{foorm}/{foormtype}/{constraintField}/{constraintValue}/{foormpk?}', [FoormActionController::class,'deleteConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
//
//
//    //PARAMETRI DA METTERE IN POST: ids (array)
//    Route::post('multi-delete/{foorm}/{foormtype}/{constraintField}/{constraintValue}/{foormpk?}', [FoormActionController::class,'postMultiDeleteConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    //PARAMETRI DA METTERE IN POST: field, value
//    Route::post('set/{foorm}/{foormtype}/{constraintField}/{constraintValue}/{foormpk?}', [FoormActionController::class,'postSetConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    //PARAMETRI DA METTERE IN POST: field, value. opzionali: n_items
//    //Il campo field (nel caso di autocomplete su un campo di una relazione è della forma relation|field
//    Route::post('autocomplete/{foorm}/{foormtype}/{constraintField}/{constraintValue}/{foormpk?}', [FoormActionController::class,'postAutocompleteConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    //PARAMETRI DA METTERE IN POST: field (es: attachment|resource)
//    Route::post('uploadfile/{foorm}/{foormtype}/{constraintField}/{constraintValue}/{foormpk?}', [FoormActionController::class,'postUploadfileConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    //PARAMETRI DA METTERE IN POST: csvType (opzionale: 'default')
//    //DA DEFINIRE
//    Route::post('csv-export/{foorm}/{foormtype}/{constraintField}/{constraintValue}/{foormpk?}', [FoormActionController::class,'postCsvExportConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    Route::post('pdf-export/{foorm}/{foormtype}/{constraintField}/{constraintValue}/{foormpk?}', [FoormActionController::class,'postPdfExportConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
});


Route::group(['prefix' => 'foorm','middleware' => 'auth:sanctum'], function () {
    $whereFoorm = join("|", \Gecche\Cupparis\App\Facades\Cupparis::get('foorm.entities'));
    //die($whereFoorm);
    //die ($where);
    Route::get('{foorm}/search/{type?}', [FoormController::class,'getSearch'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::get('{foorm}/new/{type?}', [FoormController::class,'getNew'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::get('{foorm}/list/{type}', [FoormController::class,'getList'])->where([
        'foorm' => $whereFoorm
    ]);
    Route::get('{foorm}/{id}/edit/{type?}', [FoormController::class,'getEdit'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::get('{foorm}/{id}/{type?}', [FoormController::class,'getShow'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::post('{foorm}/{type?}', [FoormController::class,'postCreate'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::put('{foorm}/{id}/{type?}', [FoormController::class,'postUpdate'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::get('{foorm}/{type?}', [FoormController::class,'getList'])->where([
        'foorm' => $whereFoorm
    ]);
});

Route::group(['prefix' => 'foormc', 'as' => 'foormc','middleware' => 'auth:sanctum'], function () {
    $whereFoorm = join("|", \Gecche\Cupparis\App\Facades\Cupparis::get('foorm.entities'));

    //die ($where);
    Route::get('{foorm}/search/{constraintField}/{constraintValue}/{type?}', [FoormController::class,'getSearchConstrained'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::get('{foorm}/new/{constraintField}/{constraintValue}/{type?}', [FoormController::class,'getNewConstrained'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::get('{foorm}/{id}/edit/{constraintField}/{constraintValue}/{type?}', [FoormController::class,'getEditConstrained'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::get('{foorm}/{id}/{constraintField}/{constraintValue}/{type?}', [FoormController::class,'getShowConstrained'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::post('{foorm}/{constraintField}/{constraintValue}/{type?}', [FoormController::class,'postCreateConstrained'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::put('{foorm}/{id}/{constraintField}/{constraintValue}/{type?}', [FoormController::class,'postUpdateConstrained'])->where([
        'foorm' => $whereFoorm
    ]);

    Route::get('{foorm}/{constraintField}/{constraintValue}/{type?}', [FoormController::class,'getListConstrained'])->where([
        'foorm' => $whereFoorm
    ]);


//    //die ($where);
//    Route::get('{foorm}/{constraintField}/{constraintValue}/search/{type?}', [FoormController::class,'getSearchConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
//
//    Route::get('{foorm}/{constraintField}/{constraintValue}/new/{type?}', [FoormController::class,'getNewConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
//
//    Route::get('{foorm}/{constraintField}/{constraintValue}/{id}/edit/{type?}', [FoormController::class,'getEditConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
//
//    Route::post('{foorm}/{constraintField}/{constraintValue}/{type?}', [FoormController::class,'postCreateConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);
//
//    Route::put('{foorm}/{constraintField}/{constraintValue}/{id}/{type?}', [FoormController::class,'postUpdateConstrained'])->where([
//        'foorm' => $whereFoorm
//    ]);

});
