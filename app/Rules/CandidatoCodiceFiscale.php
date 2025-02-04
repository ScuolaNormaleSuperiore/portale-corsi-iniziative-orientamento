<?php

namespace App\Rules;

use App\Models\Candidato;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class CandidatoCodiceFiscale implements Rule
{

    protected $data = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }


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
        $iniziativaId = Arr::get($this->data,'iniziativa_id');
        $candidaturaId = Arr::get($this->data,'id');

        $candidatura = Candidato::where('iniziativa_id', $iniziativaId)
            ->where('codice_fiscale', $value);

        if ($candidaturaId) {

            $candidatura->where('id', '!=', $candidaturaId);
        }
        $candidatura = $candidatura->first();

        Log::info("CAND COD:::");
        Log::info($value);
        Log::info($this->data);

        if ($candidatura && $candidatura->getKey()) {
            Log::info($candidatura->getKey());
            return false;
        }

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Esiste già una candidatura con questo codice fiscale";
    }
}
