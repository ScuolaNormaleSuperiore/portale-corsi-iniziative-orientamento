<?php
namespace Database\Seeders;

use App\Models\Corso;
use App\Models\Iniziativa;
use App\Models\Materia;
use App\Models\Settore;
use App\Models\SezioneLayout;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class IniziativeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('iniziative')->where('id','>',0)->delete();

        $iniziativa = Iniziativa::create([
            "id" => 1,
			"anno" => 2024,
			"titolo" => "Prova",
			"descrizione" => "<p>Iniziativa di prova</p>",
			"data_apertura" => "2024-11-01",
			"data_chiusura" => "2025-12-31",
			"posti" => 50,
			"posti_onere" => 50,
			"note" => "Note iniziativa di prova",
			"modalita_candidatura" => "Candidatura singola e tramite scuola",
			"attivo" => 1,
        ]);

        $corsoData1 = [
            "id" => 1,
			"titolo" => "Corso 1",
			"descrizione" => "<p>Corso a Pisa</p>",
			"data_inizio" => "2025-05-01",
			"data_fine" => "2025-08-01",
			"note" => "Note corso 1",
			"iniziativa_id" => 1,
			"luogo" => "Pisa",
			"indirizzo" => "Piazza dei Cavalieri",
			"provincia_id" => 50,
			"attivo" => 1
        ];


        $corsoData2 = [
            "id" => 2,
			"titolo" => "Corso 2",
			"descrizione" => "<p>Corso a Livorno</p>",
			"data_inizio" => "2025-06-01",
			"data_fine" => "2025-09-01",
			"note" => "Note corso ",
			"iniziativa_id" => 1,
			"luogo" => "Livorno",
			"indirizzo" => "Piazza Mazzini",
			"provincia_id" => 49,
			"attivo" => 1,
		];

        $corsoData3 = [
            "id" => 3,
            "titolo" => "Corso 3",
            "descrizione" => "<p>Corso a Lucca</p>",
            "data_inizio" => "2025-06-01",
            "data_fine" => "2025-09-01",
            "note" => "Note corso 3",
            "iniziativa_id" => 1,
            "luogo" => "Lucca",
            "indirizzo" => "via Fillungo 47",
            "provincia_id" => 46,
            "attivo" => 1,
        ];

        Corso::create($corsoData1);
        Corso::create($corsoData2);
        Corso::create($corsoData3);



        $iniziativa = Iniziativa::create([
            "id" => 2,
            "anno" => 2024,
            "titolo" => "Prova 2",
            "descrizione" => "<p>Iniziativa di prova 2</p>",
            "data_apertura" => "2024-12-01",
            "data_chiusura" => "2025-11-30",
            "posti" => 80,
            "posti_onere" => 80,
            "note" => "Note iniziativa di prova 2",
            "modalita_candidatura" => "Candidatura singola e tramite scuola",
            "attivo" => 1,
        ]);

        $corsoData1 = [
            "titolo" => "Corso 1b",
            "descrizione" => "<p>Corso a Pisa</p>",
            "data_inizio" => "2025-05-01",
            "data_fine" => "2025-08-01",
            "note" => "Note corso 1b",
            "iniziativa_id" => 2,
            "luogo" => "Pisa",
            "indirizzo" => "Piazza dei Cavalieri",
            "provincia_id" => 50,
            "attivo" => 1
        ];


        $corsoData2 = [
            "titolo" => "Corso 2b",
            "descrizione" => "<p>Corso a Livorno</p>",
            "data_inizio" => "2025-06-01",
            "data_fine" => "2025-09-01",
            "note" => "Note corso ",
            "iniziativa_id" => 2,
            "luogo" => "Livorno",
            "indirizzo" => "Piazza Mazzini",
            "provincia_id" => 49,
            "attivo" => 1,
        ];

        $corsoData3 = [
            "titolo" => "Corso 3b",
            "descrizione" => "<p>Corso a Lucca</p>",
            "data_inizio" => "2025-06-01",
            "data_fine" => "2025-09-01",
            "note" => "Note corso 3",
            "iniziativa_id" => 2,
            "luogo" => "Lucca",
            "indirizzo" => "via Fillungo 47",
            "provincia_id" => 46,
            "attivo" => 1,
        ];

        $corsoData4 = [
            "titolo" => "Corso 4b",
            "descrizione" => "<p>Corso a Massa</p>",
            "data_inizio" => "2025-06-01",
            "data_fine" => "2025-09-01",
            "note" => "Note corso 4b",
            "iniziativa_id" => 2,
            "luogo" => "Massa",
            "indirizzo" => "Piazza garibaldi 34",
            "provincia_id" => 45,
            "attivo" => 1,
        ];

        Corso::create($corsoData1);
        Corso::create($corsoData2);
        Corso::create($corsoData3);
        Corso::create($corsoData4);


    }
}
