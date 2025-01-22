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
                'supervisor_id' => 1,
            ],
            [
                'name' => 'IT B3',
                'slug' => 'it-b3',
                'supervisor_id' => 2,
            ],
            [
                'name' => 'IT A4',
                'slug' => 'it-a4',
                'supervisor_id' => 3,
            ],
            [
                'name' => 'IT C4',
                'slug' => 'it-c4',
                'supervisor_id' => 4,
            ],
            [
                'name' => 'DH Corridor',
                'slug' => 'dh-corridor',
                'supervisor_id' => 5,
            ],
            [
                'name' => 'DH 5',
                'slug' => 'dh-5',
                'supervisor_id' => 6,
            ],
            [
                'name' => 'DH 6',
                'slug' => 'dh-6',
                'supervisor_id' => 7,
            ],
            [
                'name' => 'DH 7',
                'slug' => 'dh-7',
                'supervisor_id' => 8,
            ],
            [
                'name' => 'DH 8',
                'slug' => 'dh-8',
                'supervisor_id' => 9,
            ],
            [
                'name' => 'Mechanical Gantry',
                'slug' => 'mechanical-gantry',
                'supervisor_id' => 10,
            ],
        ];

        foreach ($groups as $group) {
            \App\Models\Group::create($group);
        }
        // $supervisors = User::role('Supervisor')->get();
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
