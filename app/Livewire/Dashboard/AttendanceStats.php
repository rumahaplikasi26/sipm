<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Shift;
use Livewire\Attributes\On;

class AttendanceStats extends Component
{
    public $totalIN = 0;
    public $totalBreakIn = 0;
    public $totalBreakOut = 0;
    public $totalOUT = 0;
    public $date;
    public $dateString;
    public $shift_id;
    public $shift;

    public function mount($date, $shift_id)
    {
        $this->date = $date;
        $this->shift_id = $shift_id;
        $this->dateString = Carbon::parse($date)->format('d F Y');
        $this->shift = Shift::find($shift_id);

        $this->calculateAttendance();
    }

    #[On('updatedData')]
    public function updatedDate($date, $shift_id)
    {
        $this->date = $date;
        $this->shift_id = $shift_id;

        $this->dateString = Carbon::parse($date)->format('d F Y');
        $this->shift = Shift::find($shift_id);
        $this->calculateAttendance();
    }

    public function calculateAttendance()
    {
        $this->totalIN = 0;
        $this->totalBreakIn = 0;
        $this->totalBreakOut = 0;
        $this->totalOUT = 0;

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

                return $time->between(
                    $start_adjustment,
                    $break_start->subMinute(1)
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

                return $time->between(
                    $break_start,
                    $break_end->subMinute(1)
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

                return $time->between(
                    $break_end,
                    $end_time->subMinute(1)
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

                return $time->between(
                    $end_time,
                    $end_adjustment->addMinute(60)
                );
            });
        })->count();
    }

    public function render()
    {
        return view('livewire.dashboard.attendance-stats', [
            'totalIN' => $this->totalIN,
            'totalBreakIn' => $this->totalBreakIn,
            'totalBreakOut' => $this->totalBreakOut,
            'totalOUT' => $this->totalOUT,
        ]);
    }
}
