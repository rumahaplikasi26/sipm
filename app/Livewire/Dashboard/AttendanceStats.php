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

    public function mount()
    {
        // Default to today's date if no date is provided
        $this->date =Carbon::today()->format('Y-m-d');
        $this->calculateAttendance();
    }

    #[On('updatedData')]
    public function updatedDate($date)
    {
        $this->date = $date;
        $this->calculateAttendance();
    }

    public function calculateAttendance()
    {
        // dd($this->date);
        // Ambil data attendance berdasarkan tanggal
        $attendances = Attendance::with('shift')
            ->whereDate('timestamp', $this->date)
            ->get();

        // Hitung Total Start
        $this->totalIN = $attendances->where(function ($attendance) {
            $time = Carbon::parse($attendance->timestamp);
            $shift = $attendance->shift;
            return $time->between(
                Carbon::parse($shift->start_adjustment),
                Carbon::parse($shift->break_start_time)->subMinute(1)
            );
        })->count();

        // Hitung Total Break IN
        $this->totalBreakIn = $attendances->where(function ($attendance) {
            $time = Carbon::parse($attendance->timestamp);
            $shift = $attendance->shift;
            return $time->between(
                Carbon::parse($shift->break_start_time),
                Carbon::parse($shift->break_end_time)->subMinute(1)
            );
        })->count();

        // Hitung Total Break OUT
        $this->totalBreakOut = $attendances->where(function ($attendance) {
            $time = Carbon::parse($attendance->timestamp);
            $shift = $attendance->shift;
            return $time->between(
                Carbon::parse($shift->break_end_time),
                Carbon::parse($shift->end_adjustment)->subMinute(1)
            );
        })->count();

        // Hitung Total End
        $this->totalOUT = $attendances->where(function ($attendance) {
            $time = Carbon::parse($attendance->timestamp);
            $shift = $attendance->shift;
            return $time->gt(Carbon::parse($shift->end_adjustment));
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
