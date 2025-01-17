<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Il campo :attribute deve essere accettato.',
    'active_url' => 'Il campo :attribute non &egrave; URL valido.',
    'after' => 'Il campo :attribute deve essere una data successiva a :date.',
    'alpha' => 'Il campo :attribute pu&ograve; solo contenere lettere.',
    'alpha_dash' => 'Il campo :attribute pu&ograve; solo contenere lettere, numeri e i caratteri - e _.',
    'alpha_num' => 'Il campo :attribute pu&ograve; solo contenere lettere e numeri.',
    'array' => 'Il campo :attribute deve essere un vettore.',
    'before' => 'Il campo :attribute deve essere una data anteriore a :date.',
    'between' =>
        [
            'numeric' => 'Il campo :attribute deve avere un valore compreso tra :min e :max.',
            'file' => 'Il campo :attribute deve avere una dimensione compresa tra :min e :max kilobytes.',
            'string' => 'Il campo :attribute deve avere una lunghezza compresa tra :min e :max caratteri.',
            'array' => 'Il campo :attribute deve avere un numero di elementi compreso tra :min e :max.',
        ],
    'captcha' => 'Le lettere di controllo immagine non corrispondono',
    'confirmed' => 'Il campo :attribute e la sua conferma non corrispondono.',

    'date' => 'Il campo :attribute non &egrave; una data valida.',
    'date_format' => 'Il campo :attribute non corrisponde al formato :format.',
    'different' => 'Il campo :attribute e :other devono essere diversi.',
    'digits' => 'Il campo :attribute deve avere un numero di cifre uguale a :digits.',
    'digits_between' => 'Il campo :attribute deve avere un numero di cifre compreso tra :min e :max.',
    'email' => 'Il campo :attribute deve essere un indirizzo e-mail valido.',
    'exists' => 'Il campo :attribute non &egrave; valido (il valore non corrisponde a quelli esistenti).',
    'image' => 'Il campo :attribute deve essere una immagine.',
    'in' => 'Il campo :attribute non &egrave; valido (il valore non corrisponde a quelli esistenti).',
    'integer' => 'Il campo :attribute deve essere un numero intero.',
    'ip' => 'Il campo :attribute deve essere un valido indirizzo IP.',
    'max' =>
        [
            'numeric' => 'Il campo :attribute non pu&ograve; essere maggiore di :max.',
            'file' => 'Il campo :attribute non pu&ograve; avere una dimensione maggiore di :max kilobytes.',
            'string' => 'Il campo :attribute non pu&ograve; avere una lunghezza superiore di :max caratteri.',
            'array' => 'Il campo :attribute non pu&ograve; avere un numero di elementi maggiore di :max.',
        ],
    'mimes' => 'Il campo :attribute deve essere a file del tipo: :values.',
    'min' =>
        [
            'numeric' => 'Il campo :attribute deve essere almeno :min.',
            'file' => 'Il campo :attribute deve avere una dimensione di almeno :min kilobytes.',
            'string' => 'Il campo :attribute deve avere una lunghezza di almeno :min caratteri.',
            'array' => 'Il campo :attribute deve avere almeno :min elementi.',
        ],
    'not_in' => 'Il campo :attribute non &egrave; valido.',
    'numeric' => 'Il campo :attribute deve essere un numero.',
    'regex' => 'Il formato del campo :attribute non &egrave; valido.',
    'required' => 'Il campo :attribute &egrave; obbligatorio.',
    'required_if' => 'Il campo :attribute &egrave; obbligatorio quando il campo :other ha come valore :value.',
    'required_with' => 'Il campo :attribute &egrave; obbligatorio quando il campo/i campi :values &egrave;/sono presente/i.',
    'required_with_all' => 'Il campo :attribute &egrave; obbligatorio quando il campo/i campi :values &egrave;/sono presente/i.',
    'required_without' => 'Il campo :attribute &egrave; obbligatorio quando il campo/i campi :values NON &egrave;/sono presente/i.',
    'required_without_all' => 'Il campo :attribute &egrave; obbligatorio quando nessuno dei campi :values sono presenti.',
    'same' => 'I campi :attribute e :other devono corrispondere.',
    'size' =>
        [
            'numeric' => 'Il campo :attribute deve avere un valore di :size.',
            'file' => 'Il campo :attribute deve avere una dimensione di :size kilobytes.',
            'string' => 'Il campo :attribute deve avere una lunghezza di :size characters.',
            'array' => 'Il campo :attribute deve contenere :size elementi.',
        ],
    'timezone' => 'Il campo :attribute deve essere una valida timezone.',
    'unique' => 'Il campo :attribute &egrave; gi&agrave; esistente.',
    'url' => 'Il formato del campo :attribute non &egrave; valido.',


    'max_digits' => 'Il campo :attribute non deve avere più di :max caratteri.',



    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',

    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',

    'boolean' => 'The :attribute field must be true or false.',


    'date_equals' => 'The :attribute must be a date equal to :date.',

    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',

    'ends_with' => 'The :attribute must end with one of the following: :values.',

    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],

    'in_array' => 'The :attribute field does not exist in :other.',

    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],

    'mimetypes' => 'The :attribute must be a file of type: :values.',

    'not_regex' => 'The :attribute format is invalid.',

    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',

    'required_unless' => 'The :attribute field is required unless :other is in :values.',

    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',

    'uploaded' => 'The :attribute failed to upload.',

    'uuid' => 'The :attribute must be a valid UUID.',

    'scuola_email_required' => 'La scuola non ha una email di riferimento valida.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'corsi-id' => [
            'min' => 'E\' necessario esprimere almeno :min preferenze per i corsi',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'modalita_conoscenza_sns_id' => 'modalità di consocenza della scuola SNS',
        'voti-materia_id.*' => 'Materia (Riga voti n. :index)',
        'voti-voto_anno_1.*' => 'Voto anno precedente (Riga voti n. :index)',
        'voti-voto_anno_2.*' => 'Voto due anni precedenti (Riga voti n. :index)',
        'voti-voto_primo_quadrimestre.*' => 'Voto primo quadrimestre (Riga voti n. :index)',

    ],

];
