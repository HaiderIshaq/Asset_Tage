<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'superadmin'],
            ['name' => 'surveyor'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
