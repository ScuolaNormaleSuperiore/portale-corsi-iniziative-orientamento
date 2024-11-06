<?php namespace App\Console\Commands;


use Gecche\Foorm\Facades\Foorm;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Icons extends Command
{

    protected $signature  = 'icons
                {--path= : path dove salvare il file generato}';

    protected $description = 'Generate file icons for webgui partendo dai css fontawesome';

    public function handle() {
        $path = $this->option('path')?$this->option('path'):'.';
        $this->createFile($path);
    }
    protected function createFile($path)
    {
        $faFiles = [];
        $faFiles[] = resource_path('roma-vue-4.0.0/node_modules/@fortawesome/fontawesome-free/css/all.css');
        $icons = [];
        foreach ($faFiles as $faFileName) {
            $this->comment('file source name ' . $faFileName);
            $files = new Filesystem();
            $faFile = $files->get($faFileName);
            $icons = array_merge($icons,preg_split("#:before\{#", $faFile));
        }
        $faIcons = array_map(function ($item) {
            $dotPos = strrpos($item, '.');
            if ($dotPos === false) {
                return false;
            }
            return substr($item, $dotPos + 4);
        }, $icons);

        $faIcons = array_filter($faIcons);

        $filename = $path . '/icons.json';

//        $this->files->put($filename, "crud.lang = " . cupparis_json_encode($translations));
        file_put_contents(base_path($filename),json_encode($faIcons,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        //$this->files->put($filename, json_encode($faIcons,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        $this->comment('icone generate');


    }

}
