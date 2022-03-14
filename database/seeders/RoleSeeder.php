<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crud        = ['create','read','update','delete'];
        $roles       = ['Super User','User'];
        $permissions = ['user', 'xp', 'coin','leaderboard'];

        //Create Permissions
        foreach ($permissions as $permission) {
            foreach ($crud as $action) {
                $data = ['name' => $permission . '-' . $action];
                Permission::firstOrCreate($data);
            }
        }

        //Create Roles
        foreach ($roles as $role) {
            $data = ['name' => $role];
            Role::firstOrCreate($data);
        }

        //Add Permission to Super Admin
        $role = Role::findByName('Super User');
        $permission = Permission::select('name')->get()->toArray();
        $role->syncPermissions($permission);

        //Add Permission to User
        $role = Role::findByName('User');
        $permission = [
            'leaderboard-read',
            'xp-create', 'xp-read',
            'coin-create', 'coin-read',
        ];

    }
}
