<?php namespace App\Http\Controllers\Api;

use App\Models\Studente;
use Gecche\Cupparis\App\Http\Controllers\DownloadController as DownloadControllerCupparis;
use Gecche\Cupparis\AppVars\Facades\AppVars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadController extends DownloadControllerCupparis {

    public function viewMediableFile($mediableModelName, $mediablePk, $template = null)
    {

        Log::info("HERE VM");
        $this->redirectIfNotAuthorizedFile($mediableModelName, $mediablePk);

        $mediableModel = $this->getMediableModel($mediableModelName, $mediablePk);

        if (!$mediableModel->fileExists()) {
            return redirect('/')->withErrors('file_not_found');
        }

        $template = $template ?: Config::get('imagecache.default_template', 'small');

        $imagecacheRoute = 'imagecache/' . $template . '/' . $mediableModel->full_filename;

        $request = Request::create($imagecacheRoute, 'GET', array());

        return Route::dispatch($request);
    }


    public function downloadtemp($nome)
    {

        $filename = storage_temp_path($nome);
        Log::info("FILLLEEEE");
        Log::info($filename);
        if (File::exists($filename)) {

            if (Str::endsWith($filename, 'pdf')) {
                return Response::make(file_get_contents($filename), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'attachment; filename="' . $nome . '"'
                ]);
            }
            return Response::download($filename, $nome);
        }
    }
}
