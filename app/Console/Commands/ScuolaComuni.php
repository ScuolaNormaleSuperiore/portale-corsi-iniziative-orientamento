<?php namespace App\Console\Commands;


use App\Models\Comune;
use App\Models\Scuola;
use Gecche\Foorm\Facades\Foorm;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ScuolaComuni extends Command
{

    protected $signature  = 'scuola-comuni';

    protected $description = 'Aggancia i comuni delle scuole alla tabella interna';

    public function handle() {
        $scuolaComuni = DB::table('scuole')->select(['id','catastale_comune'])
            ->get()->pluck('catastale_comune','id')->all();
        $comuni = DB::table('comuni')->select(['id','codice_catastale'])
            ->get()->pluck('id','codice_catastale')->all();

        foreach ($scuolaComuni as $scuolaId => $catastaleComune) {
            if (!array_key_exists(trim($catastaleComune), $comuni)) {
                continue;
            }
            $scuola = Scuola::find($scuolaId);
            $scuola->comune_id = $comuni[$catastaleComune];
            $scuola->save();
        }
    }

}
