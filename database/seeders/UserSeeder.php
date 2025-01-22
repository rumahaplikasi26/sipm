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

        $project_manager = User::create([
            'name' => 'Project Director',
            'email' => 'project_director@localhost',
            'password' => bcrypt('password'),
        ]);

        $project_manager->assignRole('Project Director');

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

        $quality_control = User::create([
            'name' => 'HSE',
            'email' => 'hse@localhost',
            'password' => bcrypt('password'),
        ]);

        $quality_control->assignRole('HSE');

        for ($i = 1; $i < 9; $i++) {
            $supervisor = User::create([
                'name' => 'Supervisor '.$i,
                'email' => "supervisor{$i}@localhost",
                'password' => bcrypt('password'),
            ]);

            $supervisor->assignRole('Supervisor');
        }
    }
}
