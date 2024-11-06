<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SuperadminController;

Route::group(['prefix' => 'superadmin','middleware' => 'auth:sanctum'], function () {
    //$whereFoorm = join("|", \Gecche\Cupparis\App\Facades\Cupparis::get('foorm.entities'));

    Route::middleware('auth:sanctum')->get('/models-permessi',[SuperadminController::class,'getModels']);

    //PARAMETRI DA METTERE IN POST: id
//    Route::delete('delete/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'delete'])->where([
//        'foorm' => $whereFoorm
//    ]);
//
//    //PARAMETRI DA METTERE IN POST: ids (array)
//    Route::post('multi-delete/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postMultiDelete'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    //PARAMETRI DA METTERE IN POST: field, value
//    Route::post('set/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postSet'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    //PARAMETRI DA METTERE IN POST: field, value. opzionali: n_items
//    //Il campo field (nel caso di autocomplete su un campo di una relazione è della forma relation|field
//    Route::post('autocomplete/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postAutocomplete'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    //PARAMETRI DA METTERE IN POST: field (es: attachment|resource)
//    Route::post('uploadfile/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postUploadfile'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    //PARAMETRI DA METTERE IN POST: csvType (opzionale: 'default')
//    //DA DEFINIRE
//    Route::post('csv-export/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postCsvExport'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    Route::post('pdf-export/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postPdfExport'])->where([
//        'foorm' => $whereFoorm
//    ]);
//    Route::post('split-tables/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postSplitTables'])->where([
//        'foorm' => $whereFoorm
//    ]);
//
//    Route::post('elastic-json/{foorm}/{foormtype}/{foormpk?}', [FoormActionController::class,'postElasticJson'])->where([
//        'foorm' => $whereFoorm
//    ]);
});
