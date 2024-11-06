<?php
namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Materia;
use App\Models\MateriaOrientamento;
use App\Models\Settore;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ClassiOrientamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('materie_orientamento')->where('id','>',0)->delete();
        DB::table('classi')->where('id','>',0)->delete();
        $classiJsonFile = File::get(database_path('dataset/classi.json'));


        $classiData = json_decode($classiJsonFile,true);

        $classi = [];
        foreach (Arr::get($classiData,'data',[]) as $classeData) {
            $classe = new Classe();

            $classe->nome_it = Arr::get($classeData,'nome');

            $classe->save();

            $classi[$classe->nome_it] = $classe->getKey();

        }

        $materieJsonFile = File::get(database_path('dataset/materie_orientamento.json'));


        $materieData = json_decode($materieJsonFile,true);

        foreach (Arr::get($materieData,'data',[]) as $materiaData) {
            $materia = new MateriaOrientamento();

            $materia->nome_it = Arr::get($materiaData,'nome');
            $materia->classe_id = Arr::get($classi,Arr::get($materiaData,'classe'));

            $materia->save();


        }


    }
}
