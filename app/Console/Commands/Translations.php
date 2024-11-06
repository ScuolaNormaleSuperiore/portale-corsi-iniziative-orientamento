<?php namespace App\Console\Commands;


use Gecche\Foorm\Facades\Foorm;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Translations extends \Gecche\Cupparis\App\Console\Commands\Translations
{
    protected $excludedModels = [
        'datafile_comune_istat',
    ];

    protected function createFile($lang)
    {

//        echo "ok\n";
        Auth::loginUsingId(1);


        app()->setLocale($lang);


        $translations = $this->getAppTranslations();

        $translations = $this->transUc($translations);

        $foormsToTranslate = $this->getFoormsToTranslate();

        foreach ($foormsToTranslate as $foormEntity => $formTypes) {


            foreach ($formTypes as $formType) {

                $foormToTranslate = $foormEntity . '.' . $formType;
                $this->comment($foormToTranslate);

                $params = [];

                try {
                    $foorm = Foorm::getFoorm($foormToTranslate, request(), $params);
                } catch (\Exception $e) {
                    if (!Str::startsWith($e->getMessage(), 'Configuration of foorm')) {
                        throw $e;
                    }
                }

                $foormTranslations = $this->getFoormTranslations($foorm, $foormEntity, $formType);

                if (!array_key_exists($foormEntity, $translations)) {
                    $translations[$foormEntity] = $foormTranslations[$foormEntity];
                } else {
                    $translations[$foormEntity] = array_replace_recursive($translations[$foormEntity], $foormTranslations[$foormEntity]);
//                    $keysToMerge = array_keys(Arr::get($foormTranslations, $foormEntity, []));
//                    foreach ($keysToMerge as $key) {
//                        if (!array_key_exists($key, $translations[$foormEntity])) {
//                            $translations[$foormEntity][$key] = $foormTranslations[$foormEntity][$key];
//                            continue;
//                        }
//                        if (is_array($foormTranslations[$foormEntity][$key])) {
//                            $translations[$foormEntity][$key] = array_merge($translations[$foormEntity][$key], $foormTranslations[$foormEntity][$key]);
//                        }
//                    }
                }
            }
        }


        $translations = Arr::dot($translations);

        $filename = public_path($this->dirjs . "/" . $lang . '-translations.json');

//        $this->files->put($filename, "crud.lang = " . cupparis_json_encode($translations));
        $this->files->put($filename, json_encode($translations,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        $this->comment('Traduzioni completate');


    }

}
