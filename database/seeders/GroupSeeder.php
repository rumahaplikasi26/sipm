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
        $supervisors = User::role('Supervisor')->get();
        $i = 1;
        foreach ($supervisors as $supervisor) {
            \App\Models\Group::create([
                'name' => "Group A$i",
                'slug' => "group-a$i",
                'supervisor_id' => $supervisor->id,
            ]);

            $i++;
        }
    }
}
