<?php namespace App\Console\Commands;


use App\Models\Candidato;
use App\Models\Comune;
use App\Models\Scuola;
use Gecche\Foorm\Facades\Foorm;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RicalcolaMedia extends Command
{

    protected $signature  = 'ricalcola-media';

    protected $description = 'Ricalcola la media e salva (non il modello)';

    public function handle() {
        foreach (Candidato::all() as $candidato) {
            $oldMedia = $candidato->media;
            $media = $candidato->calculateMedia();
            $this->comment("Candidato: " . $candidato->getKey() . " - Media da: " . $oldMedia . " a: " . $media);
            DB::table('candidati')->where('id',$candidato->getKey())
                ->update(['media' => $media]);
        }
    }

}
