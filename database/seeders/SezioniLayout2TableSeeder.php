<?php
namespace Database\Seeders;

use App\Models\Materia;
use App\Models\Settore;
use App\Models\SezioneLayout;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SezioniLayout2TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $sezioniJsonFile = File::get(database_path('dataset/sezioni_layout2.json'));


        $sezioniData = json_decode($sezioniJsonFile,true);

        foreach (Arr::get($sezioniData,'data',[]) as $sezioneData) {


            $codiceSezione = Arr::get($sezioneData,'codice');

            $sezione = SezioneLayout::where('codice',$codiceSezione)->firstOrNew();

            $sezione->codice = $codiceSezione;
            $sezione->nome = Arr::get($sezioneData,'nome');
            $sezione->tipo = Arr::get($sezioneData,'tipo');
            $sezione->testo_it = Arr::get($sezioneData,'testo_it');

            $sezione->save();


        }


    }
}
