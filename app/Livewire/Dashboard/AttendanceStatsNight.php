<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Shift;
use Livewire\Attributes\On;

class AttendanceStatsNight extends Component
{
    public $totalIN = 0;
    public $totalBreakIn = 0;
    public $totalBreakOut = 0;
    public $totalOUT = 0;
    public $date;
    public $dateString;
    public $shift_id;
    public $shift;

    public function mount($date)
    {
        $this->date = $date;
        $this->dateString = Carbon::parse($date)->format('d F Y');
        $this->shift = Shift::where('day_of_week', strtolower(Carbon::parse($this->date)->format('l')))->skip(1)->first();
        $this->shift_id = $this->shift->id;

        $this->calculateAttendance();
    }

    #[On('updatedData')]
    public function updatedDate($date)
    {
        $this->date = $date;

        $this->dateString = Carbon::parse($date)->format('d F Y');
        
        $this->shift = Shift::where('day_of_week', strtolower(Carbon::parse($this->date)->format('l')))->skip(1)->first();
        $this->shift_id = $this->shift->id;

        $this->calculateAttendance();
    }

    public function calculateAttendance()
    {
        // dd($this->date);
        // Ambil data attendance berdasarkan tanggal
        $attendances = Attendance::with('shift')
            ->whereDate('shift_date', $this->date)
            ->where('shift_id', $this->shift_id)
            ->get();

        // dd($attendances, $this->date, $this->shift_id);
        // Hitung Total Start (IN)
        $this->totalIN = $attendances->groupBy('employee_id')->filter(function ($group) {
            return $group->first(function ($attendance) {
                $time = Carbon::parse($attendance->timestamp);
                $shift = $attendance->shift;

                $start_adjustment = Carbon::parse($shift->start_adjustment)
                    ->setDateFrom(Carbon::parse($attendance->shift_date));
                $break_start = Carbon::parse($shift->break_start_time)
                    ->setDateFrom(Carbon::parse($attendance->shift_date));

                // \Log::info('IN Start Adjustment Hour: ' . $start_adjustment->hour);
                // \Log::info('IN Break Start Hour: ' . $break_start->hour);

                // Handle pergantian hari untuk break_start
                if ($break_start->hour < $start_adjustment->hour) {
                    $break_start->addDay();
                }

                // \Log::info('IN Start Adjustment: ' . $start_adjustment);
                // \Log::info('IN Break Start: ' . $break_start);

                return $time->between(
                    $start_adjustment,
                    $break_start
                );
            });
        })->count();

        // Hitung Total Break IN
        $this->totalBreakIn = $attendances->groupBy('employee_id')->filter(function ($group) {
            return $group->first(function ($attendance) {
                $time = Carbon::parse($attendance->timestamp);
                $shift = $attendance->shift;

                $break_start = Carbon::parse($shift->break_start_time)
                    ->setDateFrom(Carbon::parse($attendance->shift_date));
                $break_end = Carbon::parse($shift->break_end_time)
                    ->setDateFrom(Carbon::parse($attendance->shift_date));

                \Log::info('Shift 2 IN Break Start Hour: ' . $break_start->hour);
                \Log::info('Shift 2 IN Break End Hour: ' . $break_end->hour);

                // Handle istirahat jam 00:00 - 01:00 dengan pergantian hari
                if ($time > $break_start && $time > $break_end) {
                    $break_start->addDay();
                    $break_end->addDay();
                }

                \Log::info('Shift 2 IN Break Start: ' . $break_start);
                \Log::info('Shift 2 IN Break End: ' . $break_end);

                return $time->between(
                    $break_start,
                    $break_end
                );
            });
        })->count();

        // Hitung Total Break OUT
        $this->totalBreakOut = $attendances->groupBy('employee_id')->filter(function ($group) {
            return $group->first(function ($attendance) {
                $time = Carbon::parse($attendance->timestamp);
                $shift = $attendance->shift;

                $break_end = Carbon::parse($shift->break_end_time)
                    ->setDateFrom(Carbon::parse($attendance->shift_date));
                $end_time = Carbon::parse($shift->end_time)
                    ->setDateFrom(Carbon::parse($attendance->shift_date));

                // \Log::info('OUT Break End Hour: ' . $break_end->hour);
                // \Log::info('OUT End Time Hour: ' . $end_time->hour);

                // Handle pergantian hari untuk break_end dan end_time
                if ($time > $break_end && $time > $end_time) {
                    $break_end->addDay();
                    $end_time->addDay();
                }

                // \Log::info('OUT Break End: ' . $break_end);
                // \Log::info('OUT End Time: ' . $end_time);

                return $time->between(
                    $break_end,
                    $end_time
                );
            });
        })->count();

        // Hitung Total End (OUT)
        $this->totalOUT = $attendances->groupBy('employee_id')->filter(function ($group) {
            return $group->first(function ($attendance) {
                $time = Carbon::parse($attendance->timestamp);
                $shift = $attendance->shift;

                $end_time = Carbon::parse($shift->end_time)
                    ->setDateFrom(Carbon::parse($attendance->shift_date));
                $end_adjustment = Carbon::parse($shift->end_adjustment)
                    ->setDateFrom(Carbon::parse($attendance->shift_date));

                // \Log::info('OUT End Time Hour: ' . $end_time);
                // \Log::info('OUT End Adjustment Hour: ' . $end_adjustment);

                // Handle pergantian hari untuk end_adjustment
                if($end_adjustment->hour < 6){
                    $end_time->addDay();
                    $end_adjustment->addDay();
                }

                // \Log::info('OUT End Time: ' . $end_time);
                // \Log::info('OUT End Adjustment: ' . $end_adjustment);

                return $time->between(
                    $end_time,
                    $end_adjustment
                );
            });
        })->count();

        $this->dispatch('refreshCard');
    }

    public function render()
    {
        return view('livewire.dashboard.attendance-stats-night');
    }
}
