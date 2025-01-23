<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => 'IT A3',
                'slug' => 'it-a3',
            ],
            [
                'name' => 'IT B3',
                'slug' => 'it-b3',
            ],
            [
                'name' => 'IT A4',
                'slug' => 'it-a4',
            ],
            [
                'name' => 'IT C4',
                'slug' => 'it-c4',
            ],
            [
                'name' => 'DH Corridor',
                'slug' => 'dh-corridor',
            ],
            [
                'name' => 'DH 5',
                'slug' => 'dh-5',
            ],
            [
                'name' => 'DH 6',
                'slug' => 'dh-6',
            ],
            [
                'name' => 'DH 7',
                'slug' => 'dh-7',
            ],
            [
                'name' => 'DH 8',
                'slug' => 'dh-8',
            ],
            [
                'name' => 'Mechanical Gantry',
                'slug' => 'mechanical-gantry',
            ],
        ];

        $supervisors = User::role('Supervisor')->get();
        foreach ($groups as $key =>  $group) {
            \App\Models\Group::create([
                'name' => $group['name'],
                'slug' => $group['slug'],
                'supervisor_id' => $supervisors[$key]->id,
            ]);
        }
        // $i = 1;
        // foreach ($supervisors as $supervisor) {
        //     \App\Models\Group::create([
        //         'name' => "Group A$i",
        //         'slug' => "group-a$i",
        //         'supervisor_id' => $supervisor->id,
        //     ]);

        //     $i++;
        // }
    }
}
