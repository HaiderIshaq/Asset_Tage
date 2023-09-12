<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $superadminRole = Role::where('name', 'superadmin')->first();
        $surveyorRole = Role::where('name', 'surveyor')->first();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ])->roles()->attach($adminRole->id);

        User::create([
            'name' => 'Superadmin User',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ])->roles()->attach($superadminRole->id);

        User::create([
            'name' => 'Surveyor User',
            'email' => 'surveyor@example.com',
            'password' => bcrypt('password'),
        ])->roles()->attach($surveyorRole->id);
    }
}
