<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('status_activities')->insert([
            [
                'id' => 1,
                'name' => 'Active',
                'description' => 'The activity is active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Inactive',
                'description' => 'The activity is inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Pending',
                'description' => 'The activity is pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
