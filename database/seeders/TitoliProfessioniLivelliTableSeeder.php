<?php

namespace Database\Seeders;

use App\Models\LivelloLinguistico;
use App\Models\Materia;
use App\Models\ModalitaConoscenzaSns;
use App\Models\Professione;
use App\Models\Settore;
use App\Models\TitoloStudio;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TitoliProfessioniLivelliTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $entities = [
            'titoli_studio' => TitoloStudio::class,
            'professioni' => Professione::class,
            'livelli_linguistici' => LivelloLinguistico::class,
            'modalita_conoscenza_sns' => ModalitaConoscenzaSns::class,
        ];

        foreach ($entities as $entity => $entityModelClass) {
            DB::table($entity)->where('id','>',0)->delete();
            $entitiesJsonFile = File::get(database_path('dataset/' . $entity . '.json'));
            $entitiesData = json_decode($entitiesJsonFile, true);

            foreach (Arr::get($entitiesData, 'data', []) as $entityData) {
                $entityObject = new $entityModelClass();

                $entityObject->nome = Arr::get($entityData, 'nome');

                $entityObject->save();

            }
        }


    }

    /*

          anno,nome,cognome,emails,sesso,luogo_nascita,data_nascita,indirizzo,comune,cap,provincia_id,telefono,scuola_id,classe,gen1_titolo_studio_id,gen2_titolo_studio_id,gen1_professione_id,gen2_professione_id,gen1_professione_altro,gen2_professione_altro,note,partecipazione_concorsi,inglese_livello_linguistico_id,francese_livello_linguistico_id,tedesco_livello_linguistico_id,spagnolo_livello_linguistico_id,cinese_livello_linguistico_id,altre_competenze_linguistiche,esperienze_estere,settore_professionale,motivazioni,modalita_conoscenza_sns_id,informativa,media,tipo,user_id,
    [
      "anno",
      "data_candidatura",
      "nome",
      "cognome",
      "emails",
      "sesso",
      "luogo_nascita",
      "data_nascita",
      "indirizzo",
      "comune",
      "cap",
      "provincia_id",
      "telefono",
      "scuola_id",
      "classe",
      "gen1_titolo_studio_id",
      "gen2_titolo_studio_id",
      "gen1_professione_id",
      "gen2_professione_id",
      "gen1_professione_altro",
      "gen2_professione_altro",
      "note",
      "partecipazione_concorsi",
      "inglese_livello_linguistico_id",
      "francese_livello_linguistico_id",
      "tedesco_livello_linguistico_id",
      "spagnolo_livello_linguistico_id",
      "cinese_livello_linguistico_id",
      "altre_competenze_linguistiche",
      "esperienze_estere",
      "settore_professionale",
      "motivazioni",
      "modalita_conoscenza_sns_id",
      "informativa",
      "media",
      "status",

      "tipo", // singola, scuola
      "user_id", //nullable se scuola

]

     */
}
