<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Role::create(['name' => 'Superutente']);

        $roles = [
            'Admin' => Role::create(['name' => 'Admin']),
            'Operatore' => Role::create(['name' => 'Operatore']),
        ];

        $permissions = [

            'edit users' => [],
            'create users' => ['Admin'],
            'view users' => [],
            'list users' => ['Admin'],
            'delete users' => [],
            'menu users' => ['Admin'],

        ];

        foreach ($permissions as $permissionsName => $permissionRoles) {

            $permission = Permission::create(['name' => $permissionsName]);

            foreach ($permissionRoles as $permissionRole) {
                $role = Arr::get($roles,$permissionRole);
                $role->givePermissionTo($permission);
            }

        }

    }
}
