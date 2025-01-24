<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    public function definition(): array
    {
        $shift = null;
        $timestamp = $this->generateTimestamp();

        $dayOfWeek = Carbon::parse($timestamp)->format('l');
        $shifts = Shift::where('day_of_week', strtolower($dayOfWeek))->get();

        if ($shifts->isNotEmpty()) {
            foreach ($shifts as $potentialShift) {
                if ($this->isValidFingerprintTime($timestamp, $potentialShift)) {
                    $shift = $potentialShift->id;
                    break;
                }
            }
        }

        return [
            'uid' => fake('id_ID')->numberBetween(1000000000, 9000000000),
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'state' => fake('id_ID')->numberBetween(1, 4),
            'timestamp' => $timestamp,
            'machine_sn' => fake('id_ID')->randomNumber(8, true),
            'shift_id' => $shift,
        ];
    }

    // Fungsi untuk mengecek apakah waktu fingerprint sesuai dengan shift
    protected function isValidFingerprintTime($timestamp, $shift)
    {
        $time = Carbon::parse($timestamp);

        // Parse start and end adjustments as Carbon instances with dynamic dates based on the timestamp's date
        $startAdjustment = Carbon::parse($time->toDateString() . ' ' . $shift->start_adjustment);
        $endAdjustment = Carbon::parse($time->toDateString() . ' ' . $shift->end_adjustment);

        // Handle cases where end time is earlier than start time (crosses midnight)
        if ($endAdjustment->lt($startAdjustment)) {
            $endAdjustment = $endAdjustment->addDay(); // Add one day if it crosses midnight
        }

        // Adjust to previous day for timestamps in early morning (00:00 - 05:59)
        if ($time->hour < 6) {
            // If timestamp is between midnight and 5 AM, adjust the start and end for the previous day
            $startAdjustment = $startAdjustment->subDay();
            $endAdjustment = $endAdjustment->subDay();
        }

        // Debugging logs
        \Log::info('Checking Shift ID: ' . $shift->id);
        \Log::info('Timestamp: ' . $time);
        \Log::info('Start Adjustment: ' . $startAdjustment);
        \Log::info('End Adjustment: ' . $endAdjustment);

        // Check if the timestamp falls within the range
        if ($time->between($startAdjustment, $endAdjustment)) {
            \Log::info('Valid Shift Found: ' . $shift->id);
            return true;
        }

        return false;
    }

    protected function generateTimestamp()
    {
        return fake()->dateTimeBetween('-7 days', 'now')->format('Y-m-d H:i:s');
    }
}
