<?php

namespace App\Services;

/*
 * CLASSE PER GESTIRE LA FASE DI UPLOADI UN FILE.
 * EVENTUALMENTE DA FARE COME PROVIDER E FACADE IN FUTURO.
 * PER ORA SERVIZIO AL VOLO COME SINGLETON.
 */

use Illuminate\Support\Str;

class UploadService  extends \Gecche\Cupparis\App\Services\UploadService
{

    public function getTempFileArray($type,$file,$tempFileName) {

        $methodName = 'getTempFileArray' . Str::studly($type);

        if (method_exists($this,$methodName)) {
            return $this->$methodName($file,$tempFileName);
        }

// TODO creare una copia per copy()
        return [
            'id' => $tempFileName,
            'mimetype' => $file->getClientMimeType(),
            'filename' => $file->getClientOriginalName(),

            'url' => $this->getUrl($type,$tempFileName),
            'dim' => FormatValues::filesize(storage_temp_path($tempFileName)),
        ];
    }

}
