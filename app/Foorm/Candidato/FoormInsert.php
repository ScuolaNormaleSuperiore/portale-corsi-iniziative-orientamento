<?php

namespace App\Foorm\Candidato;


use App\Models\Comune;
use Gecche\Cupparis\App\Foorm\Base\FoormInsert as BaseFoormInsert;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FoormInsert extends BaseFoormInsert
{
    protected $step;

    use CandidatoTrait;

    public function getExtraDefaults()
    {
        $role = auth_role_name();

        switch ($role) {
            case 'Admin':
            case 'Superutente':
            case 'Operatore':
                $this->extraDefaults['informativa'] = true;
            case 'Studente':
                $user = Auth::user();
                $this->extraDefaults['nome'] = $user->nome;
                $this->extraDefaults['cognome'] = $user->cognome;
                $this->extraDefaults['emails'] = $user->email;
                $info = $user->info;
                $mapping = [
                    "spidFiscalNumber" => 'codice_fiscale',
                    "spidMobilePhone" => 'telefono',
                    "spidAddress" => 'indirizzo',
                    "spidDateOfBirth" => 'data_nascita',
                    "spidPlaceOfBirth" => 'luogo_nascita',
                    "spidGender" => 'sesso',
                ];
                foreach ($mapping as $spidField => $dbField) {
                    $spidValue = Arr::get(Arr::get($info, $spidField, []), 0);
                    if (!$spidValue) {
                        continue;
                    }

                    if ($spidField == 'spidPlaceOfBirth') {
                        $comune = Comune::where('codice_catastale', $spidValue)->first();
                        if ($comune) {
                            $spidValue = $comune->nome . ' (' . $comune->sigla_provincia . ')';
                        }
                    }
                    $this->extraDefaults[$dbField] = $spidValue;
                }
            default:
                break;
        }

        if (env('TEST_INSERT', false)) {
            $data = [
                'codice_fiscale' => 'TRBGBC76C17G' . str_pad(rand(0, 999), 3, "0", STR_PAD_LEFT) . Str::random(1),
                'emails' => Str::random(6) . '@' . Str::random(6) . '.it',
                'sesso' => 'M',
                'data_nascita' => '1978-02-07',
                'luogo_nascita' => 'Pisa',
                'nome' => 'Pippo' . Str::random(4),
                'cognome' => 'Pasticcio' . Str::random(4),
                'telefono' => '348147474',
                'indirizzo' => 'Via Arnnnnn 344',
                'cap' => '56100',
                'comune_id' => 4535,
                'provincia_id' => 53,
                'sezione' => 'A',
                'classe' => 4,
                'profilo' => 'aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks',
                'motivazioni' => 'rrrr aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks aslkdlsk asldkals dkalkd laskdl asd lsakdlas kdlaskdl aksld klak d dmas dsl dkasldk aslkd laks',

            ];

            foreach ($data as $field => $datum) {
                if (!Arr::get($this->extraDefaults, $field)) {
                    $this->extraDefaults[$field] = $datum;
                }
            }
        }

        return $this->extraDefaults;
    }
}
