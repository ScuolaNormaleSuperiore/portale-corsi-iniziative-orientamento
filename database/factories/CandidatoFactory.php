<?php

namespace Database\Factories;

use App\Enums\GareInternazionali;
use App\Enums\GareUmanistiche;
use App\Enums\GiochiChimica;
use App\Enums\OlimpiadiFisica;
use App\Enums\OlimpiadiFisicaSquadreMiste;
use App\Enums\OlimpiadiInformatica;
use App\Enums\OlimpiadiMatematica;
use App\Enums\OlimpiadiMatematicaSquadre;
use App\Enums\OlimpiadiMatematicaSquadreFemminili;
use App\Enums\OlimpiadiScienzeNaturali;
use App\Enums\Stages;
use App\Models\Candidato;
use App\Models\Iniziativa;
use App\Models\LivelloLinguistico;
use App\Models\ModalitaConoscenzaSns;
use App\Models\Professione;
use App\Models\Provincia;
use App\Models\TitoloStudio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidato>
 */
class CandidatoFactory extends Factory
{

    use LocalizeFakerFactoryTrait;


    protected $model = Candidato::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $iniziative = Iniziativa::all();
        $iniziativeIds = $iniziative->pluck('anno', 'id')
            ->all();

        $inizitivaId = Arr::random(array_keys($iniziativeIds));

//        $province = Provincia::all()->pluck('regione_id', 'id')->all();
//        $provinciaId = Arr::random(array_keys($province));
//
//        $titoliStudio = TitoloStudio::all()->pluck('id', 'id')->all();
//        $professioni = Professione::all()->pluck('id', 'id')->all();
//        $livelliLingusitici = LivelloLinguistico::all()->pluck('id', 'id')->all();
//        $modalitaConoscenza = ModalitaConoscenzaSns::all()->pluck('id', 'id')->all();
//
//        $professione1Altro = rand(1, 100) > 85 ? implode(" ",$this->faker->words(3)) : null;
//        $professione2Altro = rand(1, 100) > 85 ? implode(" ",$this->faker->words(3)) : null;
//
//        $estero = rand(1, 100) > 99;
//
//        if ($estero) {
//            $scuolaId = null;
//            $scuolaEstera = $this->faker->company;
//        } else {
//            $maxScuola = DB::table('scuole')->orderBy('id', 'DESC')->first();
//            $maxScuolaId = $maxScuola->id;
//            $scuolaId = rand(1, $maxScuolaId);
//            $scuolaEstera = null;
//
//        }
//
//        $stages = Stages::values();
//        $stagesPositions = multi_rand(rand(0,count($stages)-1),0,count($stages)-1);
//        $stagesValues = [];
//        foreach ($stagesPositions as $stagesPosition) {
//            $stagesValues[] = $stages[$stagesPosition];
//        }
//
//        $gare = GareInternazionali::values();
//        $garePositions = multi_rand(rand(0,count($gare)-1),0,count($gare)-1);
//        $gareValues = [];
//        foreach ($garePositions as $garePosition) {
//            $gareValues[] = $gare[$garePosition];
//        }


        $province = [1 => 1];
        $provinciaId = 1;

        $titoliStudio = [1];
        $professioni = [1];
        $livelliLingusitici = [1];
        $modalitaConoscenza = [1];

        $professione1Altro = null;
        $professione2Altro = null;

            $scuolaId = 1;
            $scuolaEstera = null;

        $stages = Stages::values();
        $stagesPositions = multi_rand(rand(0,count($stages)-1),0,count($stages)-1);
        $stagesValues = [];
        foreach ($stagesPositions as $stagesPosition) {
            $stagesValues[] = $stages[$stagesPosition];
        }

        $gare = GareInternazionali::values();
        $garePositions = multi_rand(rand(0,count($gare)-1),0,count($gare)-1);
        $gareValues = [];
        foreach ($garePositions as $garePosition) {
            $gareValues[] = $gare[$garePosition];
        }

        $gareUmanistiche = GareUmanistiche::values();
        $gareUmanistichePositions = multi_rand(rand(0,count($gareUmanistiche)-1),0,count($gareUmanistiche)-1);
        $gareUmanisticheValues = [];
        foreach ($gareUmanistichePositions as $gareUmanistichePosition) {
            $gareUmanisticheValues[] = $gareUmanistiche[$gareUmanistichePosition];
        }

        $this->setFakerLocale('it_IT');
        $email = $this->faker->unique()->safeEmail;
        return [
            'anno' => Arr::get($iniziativeIds, $inizitivaId),
            'iniziativa_id' => $inizitivaId,

            'nome' => $this->faker->firstName,
            'cognome' => $this->faker->lastName,
//            'codice_fiscale' => $this->faker-,
            'emails' => $email,
            'sesso' => Arr::random(['F', 'M', 'A']),
            'luogo_nascita' => $this->faker->city,
            'data_nascita' => ($this->faker->dateTimeInInterval('-19 years', '+2 years'))->format('Y-m-d'),
            'indirizzo' => $this->faker->address,
            'comune' => $this->faker->city,
            'cap' => $this->faker->postcode,
            'provincia_id' => $provinciaId,
            'regione_id' => Arr::get($province, $provinciaId),
            'telefono' => $this->faker->phoneNumber,
            'scuola_id' => $scuolaId,
            'scuola_estera' => $scuolaEstera,
            'classe' => Arr::random([3, 4, 5]),
            'sezione' => Arr::random(['A', 'B', 'C', 'D', 'E']),
            'gen1_titolo_studio_id' => Arr::random($titoliStudio),
            'gen2_titolo_studio_id' => Arr::random($titoliStudio),
            'gen1_professione_id' => $professione1Altro ? null : Arr::random($professioni),
            'gen2_professione_id' => $professione2Altro ? null : Arr::random($professioni),
            'gen1_professione_altro' => $professione1Altro,
            'gen2_professione_altro' => $professione2Altro,
            'note' => rand(1, 100) > 88 ? implode("<br/>",$this->faker->paragraphs(1)) : null,

            'olimpiadi_matematica' => Arr::random(OlimpiadiMatematica::values()),
            'olimpiadi_matematica_squadre' => Arr::random(OlimpiadiMatematicaSquadre::values()),
            'olimpiadi_matematica_squadre_femminili' => Arr::random(OlimpiadiMatematicaSquadreFemminili::values()),

            'olimpiadi_fisica' => Arr::random(OlimpiadiFisica::values()),
            'olimpiadi_fisica_squadre_miste' => Arr::random(OlimpiadiFisicaSquadreMiste::values()),

            'olimpiadi_scienze_naturali' => Arr::random(OlimpiadiScienzeNaturali::values()),
            'giochi_chimica' => Arr::random(GiochiChimica::values()),
            'olimpiadi_informatica' => Arr::random(OlimpiadiInformatica::values()),

            'stages' => $stagesValues,
            'gare_internazionali' => $gareValues,
            'gare_umanistiche' => $gareUmanisticheValues,

            'partecipazione_concorsi' => rand(1, 100) > 88 ? implode("<br/>",$this->faker->paragraphs(1)) : null,
            'inglese_livello_linguistico_id' => rand(1, 100) > 70 ? null : Arr::random($livelliLingusitici),
            'francese_livello_linguistico_id' => rand(1, 100) > 50 ? null : Arr::random($livelliLingusitici),
            'tedesco_livello_linguistico_id' => rand(1, 100) > 40 ? null : Arr::random($livelliLingusitici),
            'spagnolo_livello_linguistico_id' => rand(1, 100) > 60 ? null : Arr::random($livelliLingusitici),
            'cinese_livello_linguistico_id' => rand(1, 100) > 10 ? null : Arr::random($livelliLingusitici),
            'altre_competenze_linguistiche' => rand(1, 100) > 70 ? implode(" ",$this->faker->words(5)) : null,
            'profilo' => implode("<br/>",$this->faker->paragraphs(1)),
            'esperienze_estere' => rand(1, 100) > 70 ? implode($this->faker->paragraphs(1)) : null,
            'settore_professionale' => implode(" ",$this->faker->words(5)),
            'materie_preferite' => implode(" ",$this->faker->words(5)),
            'motivazioni' => implode("<br/>",$this->faker->paragraphs(1)),
            'modalita_conoscenza_sns_id' => Arr::random($modalitaConoscenza),
            'informativa' => 1,
            'media' => rand(80,100) / 100,
            'tipo' => 'studente',
            'user_id' => 1,
            'info' => [],

        ];
    }




}
