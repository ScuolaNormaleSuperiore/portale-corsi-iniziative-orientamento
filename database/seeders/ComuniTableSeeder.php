<?php

namespace Database\Seeders;

use App\Models\Comune;
use App\Models\Provincia;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ComuniTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


//        'anno',
//        'area_geografica',
//        'regione_id',
//        'provincia_id',
//        'codice_istituto_riferimento',
//        'denomicomune_istituto_riferimento',
//        'codice',
//        'denomicomune',
//        'indirizzo',
//        'cap',
//        'catastale_comune',
//        'comune',
//        'caratteristica',
//        'tipologia_grado_istruzione',
//        'indicazione_sede_direttivo',
//        'indicazione_sede_omnicomprensivo',
//        'email',
//        'pec',
//        'web',
//        'sede_scolastica',
//        'email_riferimento',
//        'user_id',

        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table('comuni')->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $comuniJsonFile = File::get(database_path('dataset/comuni.json'));


        $provinceMapping = [
            84 => 97,//Agrigento
            6 => 6,//Alessandria
            42 => 61,//Ancona
            51 => 54,//Arezzo
            44 => 63,//Ascoli Piceno
            5 => 5,//Asti
            64 => 79,//Avellino
            72 => 82,//Bari
            106 => 86,//Barletta-Andria-Trani
            25 => 26,//Belluno
            62 => 77,//Benevento
            16 => 14,//Bergamo
            96 => 7,//Biella
            37 => 43,//Bologna
            21 => 22,//Bolzano/Bozen
            17 => 15,//Brescia

            74 => 84,//Brindisi
            92 => 105,//Cagliari
            85 => 98,//Caltanissetta
            70 => 74,//Campobasso   74, //Campobasso
            61 => 76,//Caserta  76, //Caserta
            87 => 100,//Catania  100, //Catania
            79 => 90,//Catanzaro    90, //Catanzaro
            69 => 73,//Chieti   73, //Chieti
            13 => 11,//Como     11, //Como
            78 => 89,//Cosenza  89, //Cosenza
            19 => 17,//Cremona  17, //Cremona
            101 => 92,//Crotone    92, //Crotone
            4 => 4,//Cuneo  4, //Cuneo
            86 => 99,//Enna     99, //Enna
            105 => 64,//Fermo  64, //Fermo
            38 => 44,//Ferrara  44, //Ferrara
            48 => 51,//Firenze  51, //Firenze
            71 => 81,//Foggia   81, //Foggia
            40 => 46,//Forli'-Cesena    46, //Forlì-Cesena
            60 => 69,//Frosinone    69, //Frosinone
            10 => 37,//Genova   37, //Genova
            31 => 32,//Gorizia  32, //Gorizia
            53 => 56,//Grosseto     56, //Grosseto
            8 => 35,//Imperia    35, //Imperia
            94 => 75,//Isernia  75, //Isernia
            66 => 70,//L'Aquila     70, //L'Aquila
            11 => 38,//La Spezia    38, //La Spezia
            59 => 68,//Latina   68, //Latina
            75 => 85,//Lecce    85, //Lecce
            97 => 19,//Lecco    19, //Lecco
            49 => 52,//Livorno  52, //Livorno
            98 => 20,//Lodi     20, //Lodi
            46 => 49,//Lucca    49, //Lucca
            43 => 62,//Macerata     62, //Macerata
            20 => 18,//Mantova  18, //Mantova
            45 => 48,//Massa-Carrara    48, //Massa-Carrara
            77 => 88,//Matera   88, //Matera
            83 => 96,//Messina  96, //Messina
            15 => 13,//Milano   13, //Milano
            36 => 42,//Modena   42, //Modena
            104 => 21,//Monza e della Brianza  21, //Monza e della Brianza
            63 => 78,//Napoli   78, //Napoli
            3 => 3,//Novara     3, //Novara
            91 => 104,//Nuoro    104, //Nuoro
            95 => 106,//Oristano     106, //Oristano
            28 => 29,//Padova   29, //Padova
            82 => 95,//Palermo  95, //Palermo
            34 => 40,//Parma    40, //Parma
            18 => 16,//Pavia    16, //Pavia
            54 => 58,//Perugia  58, //Perugia
            41 => 60,//,//Pesaro e Urbino  60, //Pesaro e Urbino
            68 => 72,//Pescara  72, //Pescara
            33 => 39,//Piacenza     39, //Piacenza
            50 => 53,//Pisa     53, //Pisa
            47 => 50,//Pistoia  50, //Pistoia
            93 => 34,//Pordenone    34, //Pordenone
            76 => 87,//Potenza  87, //Potenza
            100 => 57,//Prato  57, //Prato
            88 => 101,//Ragusa   101, //Ragusa
            39 => 45,//Ravenna  45, //Ravenna
            80 => 91,//,//Reggio Calabria  91, //Reggio Calabria
            35 => 41,//Reggio Emilia    41, //Reggio nell'Emilia
            57 => 66,//Rieti    66, //Rieti
            99 => 47,//Rimini   47, //Rimini
            58 => 67,//Roma     67, //Roma
            29 => 30,//Rovigo   30, //Rovigo
            65 => 80,//Salerno  80, //Salerno
            90 => 103,//Sassari  103, //Sassari
            9 => 36,//Savona     36, //Savona
            52 => 55,//Siena    55, //Siena
            89 => 102,//Siracusa     102, //Siracusa
            14 => 12,//Sondrio  12, //Sondrio
            107 => 107,//,//Sud Sardegna   107, //Sud Sardegna
            73 => 83,//Taranto  83, //Taranto
            67 => 71,//Teramo   71, //Teramo
            55 => 59,//Terni    59, //Terni
            1 => 1,//Torino     1, //Torino
            81 => 94,//Trapani  94, //Trapani
            22 => 23,//Trento   23, //Trento
            26 => 27,//Treviso  27, //Treviso
            32 => 33,//Trieste  33, //Trieste
            30 => 31,//Udine    31, //Udine
            7 => 9,//Valle d'Aosta/Vallée d'Aoste   9, //Valle d'Aosta/Vallée d'Aoste
            12 => 10,//Varese   10, //Varese
            27 => 28,//Venezia  28, //Venezia
            103 => 8,//Verbano-Cusio-Ossola   8, //Verbano-Cusio-Ossola
            2 => 2,//Vercelli   2, //Vercelli
            23 => 24,//Verona   24, //Verona
            102 => 93,//,//Vibo Valentia  93, //Vibo Valentia
            24 => 25,//Vicenza  25, //Vicenza
            56 => 65,//Viterbo  65, //Viterbo
        ];

        $viterbo = Provincia::where('nome', 'Viterbo')->first();
        if ($viterbo->getKey() == 56) {
            DB::table('province')->increment('id',200);
            foreach ($provinceMapping as $provinciaIdOld => $provinciaIdNew) {
                DB::table('province')->where('id','=',intval($provinciaIdOld)+200)
                    ->update(['id' => $provinciaIdNew]);
            }
        }


        $comuniData = json_decode($comuniJsonFile, true);

        foreach (Arr::get($comuniData, 'data', []) as $comuneData) {
            $comune = new Comune();

            $comune->id = Arr::get($comuneData, 'id');
            $comune->nome = Arr::get($comuneData, 'nome');
            $comune->codice_istat = Arr::get($comuneData, "codice_istat");
            $comune->codice_catastale = Arr::get($comuneData, "codice_catastale");
            $comune->provincia_id = Arr::get($comuneData, "provincia_id");
            $comune->sigla_provincia = Arr::get($comuneData, "sigla_provincia");
            $comune->regione_id = Arr::get($comuneData, "regione_id");
            $comune->nazione_id = Arr::get($comuneData, "nazione_id");
            $comune->cap = Arr::get($comuneData, "cap");
            $comune->prefisso = Arr::get($comuneData, "prefisso");


            $comune->attivo = Arr::get($comuneData, "attivo", 1);

            $comune->save();


        }


    }
}
