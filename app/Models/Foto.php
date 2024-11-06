<?php

namespace App\Models;
use Gecche\Cupparis\App\Models\FotoTrait;
use Gecche\Cupparis\App\Models\UploadableTraits;
use Gecche\Cupparis\App\Breeze\Breeze;


class Foto extends Breeze {
	use Relations\FotoRelations;


    use UploadableTraits;
    use FotoTrait;

    //protected $disk_driver = 'spaces-gecche1';

    public $dir = 'foto'; //e.g. allegati
    public $prefix = 'foto'; //e.g. allegato
    public $timestamps = true;
    public $ownerships = true;
    protected $table = 'fotos';
    protected $fillable = array('ext','nome','descrizione','ordine');
    protected $appends = array('full_filename','resource');
    public static $rules = array(
        //'nome' => 'required',
    );

    public static $relationsData = array(
        'mediable' => array(self::MORPH_TO, 'name' => 'mediable'),
    );


    public function getUrl()
    {
        if ($this->fileExists()) {
            return '/viewmediable/foto/'.$this->getKey() . '/orig';
        }
        return '/imagecache/small/0';
    }
}
