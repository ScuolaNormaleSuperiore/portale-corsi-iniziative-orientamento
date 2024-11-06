<?php
namespace Database\Seeders;

use App\Models\Materia;
use App\Models\Settore;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MaterieSettoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('materie')->where('id','>',0)->delete();
        DB::table('settori')->where('id','>',0)->delete();
        $materieJsonFile = File::get(database_path('dataset/materie.json'));


        $materieData = json_decode($materieJsonFile,true);

        foreach (Arr::get($materieData,'data',[]) as $materiaData) {
            $materia = new Materia();

            $materia->nome = Arr::get($materiaData,'materia');
            $materia->moltiplicatore = Arr::get($materiaData,'mul',1);

            $materia->save();


        }

        $settoriJsonFile = File::get(database_path('dataset/settori.json'));


        $settoriData = json_decode($settoriJsonFile,true);

        foreach (Arr::get($settoriData,'data',[]) as $settoreData) {
            $settore = new Settore();

            $settore->nome = Arr::get($settoreData,'desc');

            $settore->save();


        }


    }
}
