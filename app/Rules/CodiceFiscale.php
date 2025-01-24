<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CodiceFiscale implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */

    /**
     * Determine if the validation rule passes.
     *
     * Correttezza formale light di un cf italiano
     *
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $value = trim($value);
        if (empty($value)) {
            return false;
        }
        if (is_numeric(substr($value, 0, 5))) {
            return false;
        }
        if (!is_numeric(substr($value, 6, 2))) {
            return false;
        }
        if (is_numeric(substr($value, 8, 1))) {
            return false;
        }
        if (!is_numeric(substr($value, 9, 2))) {
            return false;
        }
        if (is_numeric(substr($value, 11, 1))) {
            return false;
        }
        if (!is_numeric(substr($value, 12, 3))) {
            return false;
        }
        if (is_numeric(substr($value, 15, 1))) {
            return false;
        };

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Il codice fiscale è mancante o non formalmente corretto";
    }
}
