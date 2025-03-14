<?php

namespace App\Models;


use App\Models\Relations\AttachmentRelations;
use App\Services\FormatValues;
use Gecche\Cupparis\App\Models\AttachmentTrait;
use Gecche\Cupparis\App\Models\UploadableTraits;
use Gecche\Cupparis\App\Breeze\Breeze;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;


class Attachment extends Breeze {

    use AttachmentRelations;

    use UploadableTraits;
    use AttachmentTrait;

    public $dir = 'allegati'; //e.g. allegati
    public $prefix = 'allegato'; //e.g. allegato
    public $timestamps = true;
    public $ownerships = true;
    protected $table = 'attachments';
    protected $fillable = array('ext','nome','descrizione','ordine');
    protected $appends = array('full_filename','resource','dim');

    //protected $fillable = array('nome_it', 'ext', 'descrizione_it', 'reserved');
    public static $rules = array(
        //'nome' => 'required',
    );


    public static $relationsData = array(
        'mediable' => array(self::MORPH_TO, 'name' => 'mediable'),
    );


    //protected $dirPolicy = 'mod100';

    protected function getDirPolicyMod100() {
        $id = $this->getKey();
        if (!$id) {
            throw new \Exception('AttachmentTrait id required');
        }
        $subDirName = $id % 100;
        return $this->dir . '/' . $subDirName;

    }

    public function setFieldsFromResource($inputArray = array(),$field = 'resource') {

        $resource = json_decode(Arr::get($inputArray,$field,""),true);

        $resourceId = Arr::get($resource,'id',false);

        $this->ext = pathinfo($resourceId, PATHINFO_EXTENSION);

        $this->nome = Arr::get($resource,'filename',null);
    }

    public function getDimAttribute() {
        if ($this->fileExists()) {
            return FormatValues::filesize(storage_path($this->getStorageFilename()));
        }
        return 0;
    }
}
