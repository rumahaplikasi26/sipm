<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Position;
use App\Models\Scope;
use App\Models\StatusActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' =>  fake('id_ID')->date(),
            'title' => fake('id_ID')->sentence(3),
            'slug' => fake('id_ID')->slug(),
            'group_id' => Group::inRandomOrder()->first()->id,
            'position_id' => Position::inRandomOrder()->first()->id,
            'scope_id' => Scope::inRandomOrder()->first()->id,
            'total_estimate' => fake('id_ID')->randomFloat(0, 0, 100),
            'type_estimate' => fake('id_ID')->randomElement(['hour', 'day', 'week', 'month', 'year']),
            'forecast_date' => fake('id_ID')->date(),
            'plan_date' => fake('id_ID')->date(),
            'actual_date' => fake('id_ID')->date(),
            'supervisor_id' => User::inRandomOrder()->first()->id,
            'description' => fake('id_ID')->text(100),
            'status_id' => StatusActivity::inRandomOrder()->first()->id
        ];
    }
}
