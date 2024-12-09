<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(RegioniProvinceTableSeeder::class);
        $this->call(MaterieSettoriTableSeeder::class);
        $this->call(TitoliProfessioniLivelliTableSeeder::class);
        $this->call(ClassiOrientamentoTableSeeder::class);
        $this->call(SezioniLayoutTableSeeder::class);

        $this->call(IniziativeTableSeeder::class);
    }
}
