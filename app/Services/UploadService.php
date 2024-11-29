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
            'dim' => $this->filesize_formatted(storage_temp_path($tempFileName)),
        ];
    }

    protected function filesize_formatted($path)
    {
        $size = filesize($path);
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}
