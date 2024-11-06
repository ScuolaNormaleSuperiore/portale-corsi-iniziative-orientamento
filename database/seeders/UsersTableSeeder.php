<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        $users = factory(App\User::class, 3)->make();
        // \App\Models\User::factory(10)->create();



        $usersData = [
            [
                'password' => 'massi1234',
                'email' => 'massimiliano.pardini@gmail.com',
                'name' => 'massimiliano.pardini@gmail.com',
                'nome' => 'Massimiliano',
                'cognome' => 'Pardini',
//                'codice_fiscale' => 'TRRGCM78B07G702C',
                'role' => 'Superutente',
            ],
            [
                'password' => 'amministratore',
                'email' => 'amministratore@amministratore.it',
                'name' => 'amministratore@amministratore.it',
                'nome' => 'Amministratore',
                'cognome' => 'Amministratore',
//                'codice_fiscale' => 'AMMGCM78B07G702C',
                'role' => 'Admin',
            ],
        ];

        foreach ($usersData as $userData) {
            $user = new User;

            $user->name = $userData['email'];
            $user->email = $userData['email'];
            $user->nome = $userData['nome'];
            $user->cognome = $userData['cognome'];
//            $user->codice_fiscale = $userData['codice_fiscale'];
            $user->password = bcrypt($userData['password']);
            $user->remember_token = \Illuminate\Support\Str::random(10);
            //$user->verified = 1;

            $user->save();
            $user->assignRole($userData['role']);


        }



        \Illuminate\Support\Facades\Auth::loginUsingId(3);
        \App\Models\User::factory(10)->create()->each(function($u) {

            //$role = $localizedFaker->boolean(85) ? 'Operatore' : 'Admin'; //15% Admin, 85% Operatore
//            $role = rand(0,100) > 80 ? 'Operatore' : 'Cliente';
            $role = 'Operatore';
            $u->assignRole($role);

        });

    }
}
