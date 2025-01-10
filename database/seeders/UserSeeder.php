<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@localhost',
            'password' => bcrypt('password'),
        ]);

        $superadmin->assignRole('Super Admin');

        $site_manager = User::create([
            'name' => 'Site Manager',
            'email' => 'site_manager@localhost',
            'password' => bcrypt('password'),
        ]);

        $site_manager->assignRole('Site Manager');

        $supervisor = User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@localhost',
            'password' => bcrypt('password'),
        ]);

        $supervisor->assignRole('Supervisor');

        $project_manager = User::create([
            'name' => 'Project Manager',
            'email' => 'project_manager@localhost',
            'password' => bcrypt('password'),
        ]);

        $project_manager->assignRole('Project Manager');

        $quality_control = User::create([
            'name' => 'Quality Control',
            'email' => 'quality_control@localhost',
            'password' => bcrypt('password'),
        ]);

        $quality_control->assignRole('Quality Control');
    }
}
