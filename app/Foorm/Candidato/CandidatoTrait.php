<?php

namespace App\Foorm\Candidato;


use App\Models\Evento;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

trait CandidatoTrait
{

    public function setValidationSettings($input, $rules = null)
    {

        $validationCacheKey = 'candidatura.validation';

        if (true || !Cache::has($validationCacheKey)) {
            $steps = Config::get('fe.candidatura.steps', []);
            $validation = [];
            foreach ($steps as $stepKey => $stepData) {
                $validation[$stepKey] = [];
                foreach (Arr::get($stepData, 'sections', []) as $sectionKey => $section) {
                    foreach (Arr::get($section, 'fields', []) as $fieldName => $fieldData) {
                        $validation[$stepKey][$fieldName] = Arr::get($fieldData, 'validation', []);
                    }
                }
            }
            Cache::forever($validationCacheKey, $validation);
        }

        $validationRules = Cache::get($validationCacheKey);

        $step = Arr::get($input,'step');

        if ($step) {
            $validationRules = Arr::get($validationRules,$step,[]);
        }

        $this->validationSettings['rules'] = $validationRules;

    }

}
