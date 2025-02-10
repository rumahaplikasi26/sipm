<?php

namespace App\Livewire\Dashboard;

use App\Models\AttendanceReference;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\Attendance;
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
    public $reference;

    public $employeesIn = [];
    public $employeesBreakIn = [];
    public $employeesBreakOut = [];
    public $employeesOut = [];

    public function mount($date)
    {
        $this->date = $date;
        $this->dateString = Carbon::parse($date)->format('d F Y');
        $this->reference = AttendanceReference::where('day_of_week', strtolower(Carbon::parse($this->date)->format('l')))->skip(1)->first();

        $this->shift_id = $this->reference->id;

        $this->calculateAttendance();
    }

    #[On('updatedData')]
    public function updatedDate($date)
    {
        $this->date = $date;
        $this->dateString = Carbon::parse($date)->format('d F Y');

        $this->reference = AttendanceReference::where('day_of_week', strtolower(Carbon::parse($this->date)->format('l')))->skip(1)->first();
        $this->shift_id = $this->reference->id;

        $this->calculateAttendance();
    }

    public function calculateAttendance()
    {
        // dd($this->date);
        // Ambil data attendance berdasarkan tanggal
        $attendances = Attendance::with(['reference', 'employee.group'])
            ->whereDate('shift_date', $this->date)
            ->where('shift_id', $this->shift_id)
            ->get();

        // Reset data
        $this->employeesIn = [];
        $this->employeesBreakIn = [];
        $this->employeesBreakOut = [];
        $this->employeesOut = [];

        // Proses setiap kategori
        $this->totalIN = $this->calculateCategory($attendances, 'IN');
        $this->totalBreakIn = $this->calculateCategory($attendances, 'BreakIn');
        $this->totalBreakOut = $this->calculateCategory($attendances, 'BreakOut');
        $this->totalOUT = $this->calculateCategory($attendances, 'OUT');

        $this->dispatch('refreshCard');
    }

    private function calculateCategory($attendances, $category)
    {
        switch ($category) {
            case 'IN':
                $filterFunction = function ($attendance) {
                    return $this->isIn($attendance);
                };
                break;
            case 'BreakIn':
                $filterFunction = function ($attendance) {
                    return $this->isBreakIn($attendance);
                };
                break;
            case 'BreakOut':
                $filterFunction = function ($attendance) {
                    return $this->isBreakOut($attendance);
                };
                break;
            case 'OUT':
                $filterFunction = function ($attendance) {
                    return $this->isOut($attendance);
                };
                break;
            default:
                return 0;
        }

        // Menghitung total karyawan per kategori
        return $attendances->groupBy('employee_id')->filter(function ($group) use ($filterFunction, $category) {
            return $group->first(function ($attendance) use ($filterFunction, $category) {
                // Tentukan kategori yang dipilih (IN, BreakIn, BreakOut, OUT)
                if ($filterFunction($attendance)) {
                    $this->storeEmployeeData($attendance, $category); // Simpan data karyawan
                    return true;
                }
                return false;
            });
        })->count();
    }

    private function storeEmployeeData($attendance, $category)
    {
        switch ($category) {
            case 'IN':
                $this->employeesIn[] = $this->getEmployeeData($attendance);
                break;
            case 'BreakIn':
                $this->employeesBreakIn[] = $this->getEmployeeData($attendance);
                break;
            case 'BreakOut':
                $this->employeesBreakOut[] = $this->getEmployeeData($attendance);
                break;
            case 'OUT':
                $this->employeesOut[] = $this->getEmployeeData($attendance);
                break;
        }
    }

    private function getEmployeeData($attendance)
    {
        return [
            'employee' => $attendance->employee,
            'group' => $attendance->employee->group,
            'position' => $attendance->employee->position,
            'timestamp' => $attendance->timestamp->format('d F Y H:i'),
        ];
    }

    // Cek apakah waktu sesuai dengan kategori 'IN'
    private function isIn($attendance)
    {
        $time = Carbon::parse($attendance->timestamp);
        $reference = $attendance->reference;
        $start_adjustment = Carbon::parse($reference->start_adjustment)->setDateFrom(Carbon::parse($attendance->shift_date));
        $break_start = Carbon::parse($reference->break_start_time)->setDateFrom(Carbon::parse($attendance->shift_date));

        if ($break_start->hour < $start_adjustment->hour) {
            $break_start->addDay();
        }

        return $time->between($start_adjustment, $break_start);
    }

    // Cek apakah waktu sesuai dengan kategori 'BreakIn'
    private function isBreakIn($attendance)
    {
        $time = Carbon::parse($attendance->timestamp);
        $reference = $attendance->reference;
        $break_start = Carbon::parse($reference->break_start_time)
            ->setDateFrom(Carbon::parse($attendance->shift_date));
        $break_end = Carbon::parse($reference->break_end_time)
            ->setDateFrom(Carbon::parse($attendance->shift_date));

        // Handle pergantian hari untuk break_end
        if ($break_end->hour < $break_start->hour) {
            $break_end->addDay();
        }

        return $time->between($break_start, $break_end);
    }

    // Cek apakah waktu sesuai dengan kategori 'BreakOut'
    private function isBreakOut($attendance)
    {
        $time = Carbon::parse($attendance->timestamp);
        $reference = $attendance->reference;
        $break_end = Carbon::parse($reference->break_end_time)
            ->setDateFrom(Carbon::parse($attendance->shift_date))->addDay();
        $end_time = Carbon::parse($reference->end_time)
            ->setDateFrom(Carbon::parse($attendance->shift_date))->addDay();

        return $time->between($break_end, $end_time);
    }

    // Cek apakah waktu sesuai dengan kategori 'OUT'
    private function isOut($attendance)
    {
        $time = Carbon::parse($attendance->timestamp);
        $reference = $attendance->reference;
        $end_time = Carbon::parse($reference->end_time)
            ->setDateFrom(Carbon::parse($attendance->shift_date))->addDay();
        $end_adjustment = Carbon::parse($reference->end_adjustment)
            ->setDateFrom(Carbon::parse($attendance->shift_date))->addDay();

        return $time->between($end_time, $end_adjustment);
    }

    public function render()
    {
        return view('livewire.dashboard.attendance-stats-night');
    }
}
