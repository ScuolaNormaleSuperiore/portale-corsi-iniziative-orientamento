<?php namespace App\Console\Commands;

class Init extends \Gecche\Cupparis\App\Console\Commands\Init
{

    protected function prepareCommandsArray() {

        switch ($this->option('type')) {
            case 'standard':

                $cmdArray = [
                    ['composer' => [env('COMPOSER_PATH','composer'),'update']],
                    ['composer' => [env('COMPOSER_PATH','composer'),'dump-autoload']],
                ];

                foreach ($this->storageFoldersToInit as $folder) {
                    $cmdArray[] = ['storage' => ['shell' => 'rm -rf '. storage_path() . '/files/'.$folder.'/*']];
                }

                $postStorageCmdArray = [
                    ['mig' => [env('PHP_PATH','php'),'artisan','migrate:reset']],
                    ['mig' => [env('PHP_PATH','php'),'artisan','migrate']],
                    ['seed' => [env('PHP_PATH','php'),'artisan','db:seed','--class=DatabaseSeeder']],
                    ['seed' => [env('PHP_PATH','php'),'artisan','db:seed','--class=DumpDemoSeeder']],
                    ['seed' => [env('PHP_PATH','php'),'artisan','permissions']],
                    ['seed' => [env('PHP_PATH','php'),'artisan','cache:clear']],
                ];

                $cmdArray = array_merge($cmdArray,$postStorageCmdArray);

                break;
            default:
                $cmdArray = [];
                break;
        }
        return $cmdArray;

    }


}
