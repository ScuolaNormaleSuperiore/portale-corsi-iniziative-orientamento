<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DumpDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $dumpFile = __DIR__ . '/../dumps/sns_2024-11-05.sql';
        $path = base_path();
        $mySqlString = env('MYSQL_PATH', 'mysql') . ' --user=' . env('DB_USERNAME', '')
            . ' --password=' . env('DB_PASSWORD', '') . ' ' . env('DB_DATABASE', '')
            . ' < ' . $dumpFile;

        $cmdArray = [
            $mySqlString => 'seed',
        ];
//
//
//        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
//        foreach ($cmdArray as $cmd => $group) {
//
//            $cmdArrayProcessed[] = $cmd;
//
//            $process = Process::fromShellCommandline($cmd, $path);
//            $process->setTimeout(null);
//            $process->run();
//
//// executes after the command finishes
//            if (!$process->isSuccessful()) {
//                throw new ProcessFailedException($process);
//            }
//
//            $this->command->comment($process->getOutput());
//        }
//        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        File::ensureDirectoryExists(storage_path('files/foto'));
        File::delete(storage_path('files/foto/*'));
        File::copyDirectory(resource_path('documenti/seeder_files/foto'),storage_path('files/foto'));


        $this->command->comment('Inizializzazione completata (dump: '.$dumpFile.')');

        // $this->call("OthersTableSeeder");
    }
}
