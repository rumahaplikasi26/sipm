<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Scope;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::factory(10)->create();
        Activity::create(
            [
                'date' => date('Y-m-d'),
                'title' => fake('id_ID')->sentence(3),
                'slug' => fake('id_ID')->slug(),
                'group_id' => 1,
                'position_id' => 1,
                'scope_id' => Scope::inRandomOrder()->first()->id,
                'total_estimate' => 3,
                'type_estimate' => 'day',
                'forecast_date' =>  Carbon::now()->addDays(2),
                'plan_date' => Carbon::now()->addDays(3),
                'actual_date' => Carbon::now()->addDays(5),
                'supervisor_id' => 3,
                'description' => fake('id_ID')->text(100),
                'status_id' => 1
            ]
        );
    }
}
