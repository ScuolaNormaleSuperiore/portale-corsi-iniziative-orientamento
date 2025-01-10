<?php

namespace Database\Seeders;

use App\Models\Materia;
use App\Models\Pagina;
use App\Models\PaginaInfo;
use App\Models\Settore;
use App\Models\SezioneContenuto;
use App\Models\SezioneLayout;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PagineInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('pagine')->where('tipo', '=', 'info')->delete();
        DB::table('sezioni_contenuti')->where('sezionable_type', '=', "App\\Models\\PaginaInfo")->delete();


        $pagineJsonFile = File::get(database_path('dataset/pagine_info.json'));


        $pagineData = json_decode($pagineJsonFile, true);

        foreach (Arr::get($pagineData, 'data', []) as $paginaData) {
            $pagina = new PaginaInfo();

            $pagina->titolo_it = Arr::get($paginaData, "titolo_it");
            $pagina->sottotitolo_it = Arr::get($paginaData, "sottotitolo_it");
            $pagina->ordine = Arr::get($paginaData, "ordine");
            $pagina->attivo = Arr::get($paginaData, "attivo");
            $pagina->homepage = Arr::get($paginaData, "homepage");
            $pagina->slug_it = Arr::get($paginaData, "slug_it");
            $pagina->tipo = Arr::get($paginaData, "tipo");
            $pagina->created_at = Arr::get($paginaData, "created_at");
            $pagina->updated_at = Arr::get($paginaData, "updated_at");
            $pagina->created_by = Arr::get($paginaData, "created_by");
            $pagina->updated_by = Arr::get($paginaData, "updated_by");

            $pagina->save();

            foreach (Arr::get($paginaData,'sezioni',[]) as $sezioneKey => $sezioneData) {
                $sezione = new SezioneContenuto();
                $sezione->sezionable_id = $pagina->getKey();
                $sezione->sezionable_type = get_class($pagina);
                $sezione->nome_it = Arr::get($sezioneData,'nome_it');
                $sezione->contenuto_it = Arr::get($sezioneData,'contenuto_it');
                $sezione->ordine = $sezioneKey;

                $sezione->save();
            }


        }


    }
}
