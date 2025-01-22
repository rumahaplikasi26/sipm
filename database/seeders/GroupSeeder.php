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
        for ($i = 1; $i <= 8; $i++) {
            \App\Models\Group::create([
                'name' => "Group A$i",
                'slug' => "group-a$i",
                'supervisor_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
