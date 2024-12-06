<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Arr;

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
                'password' => 'giacomo1234',
                'email' => 'giacomo.terreni@gmail.com',
                'email_verified_at' => '2024-11-01 00:00:01',
                'name' => 'giacomo.terreni@gmail.com',
                'nome' => 'Giacomo',
                'cognome' => 'Terreni',
                'role' => 'Superutente',
            ],
            [
                'password' => 'massi1234',
                'email' => 'massimiliano.pardini@netseven.it',
                'email_verified_at' => '2024-11-01 00:00:01',
                'name' => 'massimiliano.pardini@netseven.it',
                'nome' => 'Massimiliano',
                'cognome' => 'Pardini',
                'role' => 'Superutente',
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
            $user->email_verified_at = Arr::get($userData,'email_verified_at');
            //$user->verified = 1;

            $user->save();
            $user->assignRole($userData['role']);


        }



//        \Illuminate\Support\Facades\Auth::loginUsingId(3);
//        \App\Models\User::factory(10)->create()->each(function($u) {
//
//            //$role = $localizedFaker->boolean(85) ? 'Operatore' : 'Admin'; //15% Admin, 85% Operatore
////            $role = rand(0,100) > 80 ? 'Operatore' : 'Cliente';
//            $role = 'Operatore';
//            $u->assignRole($role);
//
//        });

    }
}
