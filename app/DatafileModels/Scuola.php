<?php

namespace App\DatafileModels;

use Gecche\Cupparis\App\Breeze\BreezeDatafile;
use App\Models\DatafileError;
use App\Models\Datafile;

class Scuola extends BreezeDatafile {


	protected $table = 'datafile_scuole';

    public static $relationsData = array(
        //'address' => array(self::HAS_ONE, 'Address'),
        //'orders'  => array(self::HAS_MANY, 'Order'),
        'errors' => [self::MORPH_MANY,
            'related' => DatafileError::class,
            'name' => 'datafile_table',
            'id' => 'datafile_table_id',
            'type' => 'datafile_table_type'
        ],

        'datafile' => [self::MORPH_ONE,
            'related' => Datafile::class,
            'name' => 'datafile',
            'id' => 'datafile_id',
            'type' => 'datafile_type'
        ],
    );

    public static $rules = array(
//        'GTComIstat' => 'required|numeric|unique_datafile:datafile_comuni,GTComIstat',
//        'matricola' => 'required|unique:studenti,matricola|unique_datafile:datafile_studenti,matricola',
//        'codicefiscale' => 'required',
//        'email' => 'required|email|unique:studenti,email|unique_datafile:datafile_studenti,email',
//        'categoriaaccademica' => 'required|exists:categorieaccademiche,nome',
    );

//    public function createOptionsVettoreId() {
//        Vettore::getForSelectList();
//    }
//    public function getDatafileValidator($data = null, $uniqueRules = true, $rules = [], $customMessages = [], $customAttributes = [])
//    {
//        $v = parent::getDatafileValidator($data, $uniqueRules, $rules, $customMessages, $customAttributes);
//
//        $v->sometimes('email_unipi', 'unique:studenti,email_unipi|unique_datafile:datafile_studenti,email_unipi', function ($input) {
//            return !empty($input->email_unipi);
//        });
//        $v->sometimes('email_personale', 'unique:studenti,email_personale|unique_datafile:datafile_studenti,email_personale', function ($input) {
//            return !empty($input->email_personale);
//        });
//
//        return $v;
//    }


}