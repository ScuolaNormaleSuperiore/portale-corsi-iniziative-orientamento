<?php
namespace Database\Seeders;

use App\Models\Materia;
use App\Models\Provincia;
use App\Models\Regione;
use App\Models\Settore;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RegioniProvinceTableSeeder extends Seeder
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
        DB::table('regioni')->where('id','>',0)->delete();
        DB::table('province')->where('id','>',0)->delete();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $regioniJsonFile = File::get(database_path('dataset/regioni.json'));


        $regioniData = json_decode($regioniJsonFile,true);

        foreach (Arr::get($regioniData,'data',[]) as $regioneData) {
            $regione = new Regione();

            $regione->nome = Arr::get($regioneData,'nome_it');
            $regione->id = Arr::get($regioneData,'id');

            $regione->save();


        }

        $provinceJsonFile = File::get(database_path('dataset/province.json'));


        $provinceData = json_decode($provinceJsonFile,true);

        foreach (Arr::get($provinceData,'data',[]) as $provinciaData) {
            $provincia = new Provincia();

            $provincia->nome = Arr::get($provinciaData,'nome_it');
            $provincia->codice = Arr::get($provinciaData,'codice');
            $provincia->sigla = Arr::get($provinciaData,'sigla');
            $provincia->regione_id = Arr::get($provinciaData,'regione_id');

            $provincia->save();


        }


    }
}
