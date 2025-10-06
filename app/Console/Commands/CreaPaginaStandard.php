<?php namespace App\Console\Commands;


use App\Models\Candidato;
use App\Models\Comune;
use App\Models\Pagina;
use App\Models\Scuola;
use Gecche\Foorm\Facades\Foorm;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreaPaginaStandard extends Command
{

    protected $signature  = 'crea-pagina {titolo}';

    protected $description = 'Crea una pagina di tipo standard';

    public function handle() {
        $data = [
            'titolo_it' => $this->argument('titolo'),
            'sottotitolo_it' => null,
            'ordine' => Pagina::count() + 1,
            'tipo' => 'standard',
        ];
        Pagina::create($data);
    }

}
