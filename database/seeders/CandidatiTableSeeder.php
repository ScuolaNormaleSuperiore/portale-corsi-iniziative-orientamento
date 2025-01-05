<?php

namespace Database\Seeders;

use App\Enums\GareInternazionali;
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
use App\Models\CandidatoCorso;
use App\Models\CandidatoVoti;
use App\Models\Corso;
use App\Models\Iniziativa;
use App\Models\LivelloLinguistico;
use App\Models\ModalitaConoscenzaSns;
use App\Models\Professione;
use App\Models\Provincia;
use App\Models\Scuola;
use App\Models\TitoloStudio;
use App\Services\FormatValues;
use Database\Factories\LocalizeFakerFactoryTrait;
use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CandidatiTableSeeder extends Seeder
{

    protected $faker = null;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Factory::create('it');

        Candidato::where('id','>=',1)->delete();
        User::where('id','>',2)->delete();
        //
//        $users = factory(App\User::class, 3)->make();
        // \App\Models\User::factory(10)->create();


        $iniziative = Iniziativa::all();
        $iniziativeIds = $iniziative->pluck('anno', 'id')
            ->all();

        $province = Provincia::all()->pluck('regione_id', 'id')->all();

        $titoliStudio = TitoloStudio::all()->pluck('id', 'id')->all();
        $professioni = Professione::all()->pluck('id', 'id')->all();
        $livelliLingusitici = LivelloLinguistico::all()->pluck('id', 'id')->all();
        $modalitaConoscenza = ModalitaConoscenzaSns::all()->pluck('id', 'id')->all();

        $professione1Altro = rand(1, 100) > 85 ? implode(" ", $this->faker->words(3)) : null;
        $professione2Altro = rand(1, 100) > 85 ? implode(" ", $this->faker->words(3)) : null;

        $scuoleIds = DB::table('scuole')->pluck('id', 'id')->all();

        $materie = DB::table('materie')->pluck('id', 'id')->all();

        \Illuminate\Support\Facades\Auth::loginUsingId(3);
        foreach (range(1, 100) as $i) {

            $email = $this->faker->unique()->safeEmail . '_' . $i;
            \App\Models\User::factory(1)->create([
                'email' => $email,
                'name' => $email,
            ])->each(function ($u)
            use (
                $iniziativeIds, $province, $titoliStudio, $professioni, $materie,
                $professione2Altro, $professione1Altro, $livelliLingusitici, $modalitaConoscenza, $scuoleIds,
            ) {

                //$role = $localizedFaker->boolean(85) ? 'Operatore' : 'Admin'; //15% Admin, 85% Operatore
                $role = rand(0, 100) > 50 ? 'Studente' : 'Scuola';
//            $role = 'Operatore';
                $u->assignRole($role);

                if ($role == 'Scuola') {
                    $scuolaId = Arr::random($scuoleIds);
                    $scuola = Scuola::find($scuolaId);
                    while ($scuola->user_id) {
                        $scuolaId = Arr::random($scuoleIds);
                        $scuola = Scuola::find($scuolaId);
                    }
                    $scuola->user_id = $u->getKey();
                    $scuola->save();
                }


                foreach ($iniziativeIds as $iniziativaId => $anno) {

                    $corsiDisponibili = Corso::where('iniziativa_id',$iniziativaId)
                        ->get()->pluck('id','id')->all();

                    switch ($role) {
                        case 'Studente':
                            if (rand(1, 100) > 85) {
                                break;
                            }
                            $estero = rand(1, 100) > 99;

                            if ($estero) {
                                $scuolaId = null;
                                $scuolaEstera = $this->faker->company;
                            } else {
                                $scuolaId = Arr::random($scuoleIds);
                                $scuolaEstera = null;

                            }
                            $provinciaId = Arr::random(array_keys($province));

                            $data = [
                                'anno' => $anno,
                                'iniziativa_id' => $iniziativaId,

                                'nome' => $u->nome,
                                'cognome' => $u->cognome,
                                'emails' => $u->email,
                                'provincia_id' => $provinciaId,
                                'regione_id' => Arr::get($province, $provinciaId),
                                'scuola_id' => $scuolaId,
                                'scuola_estera' => $scuolaEstera,
                                'gen1_titolo_studio_id' => Arr::random($titoliStudio),
                                'gen2_titolo_studio_id' => Arr::random($titoliStudio),
                                'gen1_professione_id' => $professione1Altro ? null : Arr::random($professioni),
                                'gen2_professione_id' => $professione2Altro ? null : Arr::random($professioni),
                                'gen1_professione_altro' => $professione1Altro,
                                'gen2_professione_altro' => $professione2Altro,


                                'inglese_livello_linguistico_id' => rand(1, 100) > 70 ? null : Arr::random($livelliLingusitici),
                                'francese_livello_linguistico_id' => rand(1, 100) > 50 ? null : Arr::random($livelliLingusitici),
                                'tedesco_livello_linguistico_id' => rand(1, 100) > 40 ? null : Arr::random($livelliLingusitici),
                                'spagnolo_livello_linguistico_id' => rand(1, 100) > 60 ? null : Arr::random($livelliLingusitici),
                                'cinese_livello_linguistico_id' => rand(1, 100) > 10 ? null : Arr::random($livelliLingusitici),
                                'modalita_conoscenza_sns_id' => Arr::random($modalitaConoscenza),
                                'tipo' => 'studente',
                                'user_id' => $u->getKey(),
                            ];
                            $candidati = Candidato::factory()->create($data);
                            $this->createRelations($candidati,$corsiDisponibili,$materie);
                            $this->transitions($candidati);
                            break;
                        case 'Scuola':
                            $nCandidature = rand(0, 5);
                            echo " --- " . $nCandidature . ' --- ' . $u->getKey() . "\n";
                            for ($i = 1; $i <= $nCandidature; $i++) {
                                $provinciaId = Arr::random(array_keys($province));
                                $data = [
                                    'anno' => $anno,
                                    'iniziativa_id' => $iniziativaId,

                                    'nome' => $this->faker->firstName,
                                    'cognome' => $this->faker->lastName,
                                    'emails' => $this->faker->unique()->safeEmail,
                                    'provincia_id' => $provinciaId,
                                    'regione_id' => Arr::get($province, $provinciaId),
                                    'scuola_id' => $scuolaId,
                                    'scuola_estera' => null,
                                    'gen1_titolo_studio_id' => Arr::random($titoliStudio),
                                    'gen2_titolo_studio_id' => Arr::random($titoliStudio),
                                    'gen1_professione_id' => $professione1Altro ? null : Arr::random($professioni),
                                    'gen2_professione_id' => $professione2Altro ? null : Arr::random($professioni),
                                    'gen1_professione_altro' => $professione1Altro,
                                    'gen2_professione_altro' => $professione2Altro,


                                    'inglese_livello_linguistico_id' => rand(1, 100) > 70 ? null : Arr::random($livelliLingusitici),
                                    'francese_livello_linguistico_id' => rand(1, 100) > 50 ? null : Arr::random($livelliLingusitici),
                                    'tedesco_livello_linguistico_id' => rand(1, 100) > 40 ? null : Arr::random($livelliLingusitici),
                                    'spagnolo_livello_linguistico_id' => rand(1, 100) > 60 ? null : Arr::random($livelliLingusitici),
                                    'cinese_livello_linguistico_id' => rand(1, 100) > 10 ? null : Arr::random($livelliLingusitici),
                                    'modalita_conoscenza_sns_id' => Arr::random($modalitaConoscenza),
                                    'tipo' => 'scuola',
                                    'user_id' => $u->getKey(),
                                ];
                                $candidati = Candidato::factory()->create($data);
                                $this->createRelations($candidati,$corsiDisponibili,$materie);
                                $this->transitions($candidati);
                            }
                            break;
                        default:
                            break;
                    }

                }

            });

        }
    }


    protected function transitions($candidati)
    {
        if (rand(0, 100) > 15) {
            $candidati->makeTransitionAndSave('inviata');
            if (rand(0, 100) > 75) {
                $candidati->makeTransitionAndSave('approvata');
            }
        }
    }

    protected function createRelations($candidati,$corsiDisponibili,$materieDisponibili) {
        $corsi = Arr::wrap(array_rand($corsiDisponibili,rand(1,count($corsiDisponibili))));
        $j = 0;
        foreach ($corsi as $corso) {
            CandidatoCorso::create([
                'candidato_id' => $candidati->getKey(),
                'corso_id' => $corso,
                'ordine' => $j,
            ]);
            $j++;
        }

        $materie = Arr::wrap(array_rand($materieDisponibili,rand(1,30)));
        $j = 0;
        foreach ($materie as $materia) {
            CandidatoVoti::create([
                'candidato_id' => $candidati->getKey(),
                'materia_id' => $materia,
                'voto_anno_1' => FormatValues::formatNumber(rand(12,20)/2,2),
                'voto_anno_2' => FormatValues::formatNumber(rand(12,20)/2,2),
                'voto_primo_quadrimestre' => FormatValues::formatNumber(rand(12,20)/2,2),
//                'ordine' => $j,
            ]);
            $j++;
        }
    }
}
