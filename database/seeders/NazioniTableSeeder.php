<?php

namespace Database\Seeders;

use App\Models\Materia;
use App\Models\Nazione;
use App\Models\Provincia;
use App\Models\Regione;
use App\Models\Settore;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NazioniTableSeeder extends Seeder
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
//        'denominazione_istituto_riferimento',
//        'codice',
//        'denominazione',
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
        DB::table('nazioni')->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $nazioniJsonFile = File::get(database_path('dataset/nazioni.json'));


        $nazioniData = json_decode($nazioniJsonFile, true);

        foreach (Arr::get($nazioniData, 'data', []) as $nazioneData) {
            $nazione = new Nazione();

            $nazione->nome = Arr::get($nazioneData, 'nome');
            $nazione->id = Arr::get($nazioneData, 'id');
            $nazione->codice_istat = Arr::get($nazioneData, "codice_istat");
            $nazione->codice_catastale = Arr::get($nazioneData, "codice_catastale");
            $nazione->codice_iso_2 = Arr::get($nazioneData, "codice_iso_2");
            $nazione->codice_iso_3 = Arr::get($nazioneData, "codice_iso_3");
            $nazione->attivo = Arr::get($nazioneData, "attivo",1);

            $nazione->save();


        }



    }
}
