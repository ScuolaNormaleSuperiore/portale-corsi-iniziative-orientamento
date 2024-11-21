<?php

namespace App\Rules;

use App\Models\Scuola;
use Illuminate\Contracts\Validation\Rule;

class ScuolaEmailRequired implements Rule
{

    public function passes($attribute, $value)
    {
        $scuola = Scuola::find($value);
        if (!$scuola || !$scuola->email_riferimento || !filter_var($scuola->email_riferimento,FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;

    }

    public function message()
    {
        return trans('validation.scuola_email_required');
    }
}