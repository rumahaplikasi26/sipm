<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shift::create([
            'name' => 'Shift 1',
            'start_time' => '07:00:00',
            'break_start_time' => '12:00:00',
            'break_end_time' => '13:00:00',
            'end_time' => '17:00:00',
            'day_of_week' => 'monday'
        ]);

        Shift::create([
            'name' => 'Shift 2',
            'start_time' => '19:00:00',
            'break_start_time' => '24:00:00',
            'break_end_time' => '01:00:00',
            'end_time' => '05:00:00',
            'day_of_week' => 'monday'
        ]);

        Shift::create([
            'name' => 'Shift 1',
            'start_time' => '07:00:00',
            'break_start_time' => '12:00:00',
            'break_end_time' => '13:00:00',
            'end_time' => '17:00:00',
            'day_of_week' => 'tuesday'
        ]);

        Shift::create([
            'name' => 'Shift 2',
            'start_time' => '19:00:00',
            'break_start_time' => '24:00:00',
            'break_end_time' => '01:00:00',
            'end_time' => '05:00:00',
            'day_of_week' => 'tuesday'
        ]);

        Shift::create([
            'name' => 'Shift 1',
            'start_time' => '07:00:00',
            'break_start_time' => '12:00:00',
            'break_end_time' => '13:00:00',
            'end_time' => '17:00:00',
            'day_of_week' => 'wednesday'
        ]);

        Shift::create([
            'name' => 'Shift 2',
            'start_time' => '19:00:00',
            'break_start_time' => '24:00:00',
            'break_end_time' => '01:00:00',
            'end_time' => '05:00:00',
            'day_of_week' => 'wednesday'
        ]);

        Shift::create([
            'name' => 'Shift 1',
            'start_time' => '07:00:00',
            'break_start_time' => '12:00:00',
            'break_end_time' => '13:00:00',
            'end_time' => '17:00:00',
            'day_of_week' => 'thursday'
        ]);

        Shift::create([
            'name' => 'Shift 2',
            'start_time' => '19:00:00',
            'break_start_time' => '24:00:00',
            'break_end_time' => '01:00:00',
            'end_time' => '05:00:00',
            'day_of_week' => 'thursday'
        ]);

        Shift::create([
            'name' => 'Shift 1',
            'start_time' => '07:00:00',
            'break_start_time' => '11:30:00',
            'break_end_time' => '13:00:00',
            'end_time' => '17:00:00',
            'day_of_week' => 'friday'
        ]);

        Shift::create([
            'name' => 'Shift 2',
            'start_time' => '19:00:00',
            'break_start_time' => '24:00:00',
            'break_end_time' => '01:00:00',
            'end_time' => '05:00:00',
            'day_of_week' => 'friday'
        ]);

        Shift::create([
            'name' => 'Shift 1',
            'start_time' => '07:00:00',
            'break_start_time' => '12:00:00',
            'break_end_time' => '13:00:00',
            'end_time' => '17:00:00',
            'day_of_week' => 'saturday'
        ]);

        Shift::create([
            'name' => 'Shift 2',
            'start_time' => '19:00:00',
            'break_start_time' => '24:00:00',
            'break_end_time' => '01:00:00',
            'end_time' => '05:00:00',
            'day_of_week' => 'saturday'
        ]);

        Shift::create([
            'name' => 'Shift 1',
            'start_time' => '07:00:00',
            'break_start_time' => '12:00:00',
            'break_end_time' => '13:00:00',
            'end_time' => '17:00:00',
            'day_of_week' => 'sunday'
        ]);

        Shift::create([
            'name' => 'Shift 2',
            'start_time' => '19:00:00',
            'break_start_time' => '24:00:00',
            'break_end_time' => '01:00:00',
            'end_time' => '05:00:00',
            'day_of_week' => 'sunday'
        ]);
    }
}
