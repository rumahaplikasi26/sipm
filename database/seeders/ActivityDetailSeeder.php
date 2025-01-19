<?php

namespace Database\Seeders;

use App\Models\ActivityDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActivityDetail::factory(50)->create();
    }
}
