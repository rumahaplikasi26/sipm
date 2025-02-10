<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendance;
use App\Models\Position;
use App\Models\Shift;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class AttendancePerPositionNight extends Component
{
    public $date;
    public $dateString;
    public $shift_id;
    public $shift;
    public $attendanceData = [];

    public $showModal = false;
    public $selectedCategory = '';
    public $selectedDivision = '';
    public $supervisorData = [];

    public $employeeData = []; // Untuk menyimpan data karyawan yang akan ditampilkan
    public $selectedSupervisor = ''; // Untuk menyimpan supervisor yang dipilih


    public function mount($date)
    {
        $this->date = $date;
        $this->dateString = Carbon::parse($date)->format('d F Y');
        $this->shift = Shift::where('day_of_week', strtolower(Carbon::parse($this->date)->format('l')))->skip(1)->first();
        $this->shift_id = $this->shift->id;

        $this->generateAttendance();
    }

    public function generateAttendance()
    {
        // Ambil data attendance berdasarkan tanggal dan shift
        $attendances = Attendance::with(['shift', 'employee.group'])
            ->whereDate('shift_date', $this->date)
            ->where('shift_id', $this->shift_id)
            ->get();

        // Kelompokkan data berdasarkan divisi (group)
        $groupedAttendances = $this->groupByDivision($attendances);

        // Hitung total per kategori per divisi
        $this->attendanceData = $this->calculateTotals($groupedAttendances);

        $this->dispatch('refreshCard');
    }

    private function groupByDivision($attendances)
    {
        $grouped = [];

        foreach ($attendances as $attendance) {
            $division = $attendance->employee->position->name ?? '-';

            if (!isset($grouped[$division])) {
                $grouped[$division] = [];
            }

            $grouped[$division][] = $attendance;
        }

        return $grouped;
    }

    private function calculateTotals($groupedAttendances)
    {
        $reportData = [];

        foreach ($groupedAttendances as $division => $attendances) {
            $totalIn = $this->calculateCategory($attendances, 'IN');
            $totalBreakIn = $this->calculateCategory($attendances, 'BreakIn');
            $totalBreakOut = $this->calculateCategory($attendances, 'BreakOut');
            $totalOut = $this->calculateCategory($attendances, 'OUT');

            $reportData[] = [
                'division' => $division ?? '',
                'totalIn' => $totalIn,
                'totalBreakIn' => $totalBreakIn,
                'totalBreakOut' => $totalBreakOut,
                'totalOut' => $totalOut,
            ];
        }

        return $reportData;
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
        return collect($attendances)->groupBy('employee_id')->filter(function ($group) use ($filterFunction) {
            return $group->contains($filterFunction);
        })->count();
    }

    public function showSupervisorData($category, $division)
    {
        $this->selectedCategory = $category;
        $this->selectedDivision = $division;

        // Ambil data supervisor berdasarkan kategori dan divisi
        $this->supervisorData = $this->getSupervisorData($category, $division);
        // dd($this->supervisorData);
        $this->showModal = true;
    }

    private function getSupervisorData($category, $division)
    {
        // Ambil data attendance berdasarkan kategori dan divisi
        $attendances = Attendance::with(['employee.group.supervisor'])
            ->whereDate('shift_date', $this->date)
            ->where('shift_id', $this->shift_id);

        if ($division != '-') {
            $attendances = $attendances->whereHas('employee.position', function ($query) use ($division) {
                if ($division != '-') {
                    $query->where('name', $division);
                }
            });
        } else {
            $attendances = $attendances->whereHas('employee', function ($query) {
                $query->where('position_id', null);
            });
        }

        $attendances = $attendances->get();

        // Filter data berdasarkan kategori
        $filterFunction = match ($category) {
            'IN' => fn($attendance) => $this->isIn($attendance),
            'OUT' => fn($attendance) => $this->isOut($attendance),
            'BreakIn' => fn($attendance) => $this->isBreakIn($attendance),
            'BreakOut' => fn($attendance) => $this->isBreakOut($attendance),
            default => fn($attendance) => false,
        };

        // Hanya ambil data yang sesuai kategori
        $filteredAttendances = $attendances->filter($filterFunction);

        // Buat data unik berdasarkan employee_id agar tidak ada duplikasi
        $uniqueAttendances = $filteredAttendances->unique('employee_id');

        // Kelompokkan data berdasarkan supervisor
        $supervisorData = [];

        foreach ($uniqueAttendances as $attendance) {
            if ($filterFunction($attendance)) {
                $supervisor = $attendance->employee->group->supervisor->name ?? 'Tanpa Supervisor';
                if (!isset($supervisorData[$supervisor])) {
                    $supervisorData[$supervisor] = 0;
                }

                $supervisorData[$supervisor]++;
            }
        }

        return $supervisorData;
    }

    public function showEmployeeData($supervisor)
    {
        $this->selectedSupervisor = $supervisor;

        // Ambil data attendance berdasarkan supervisor yang dipilih
        $attendances = Attendance::with('employee')
            ->whereDate('shift_date', $this->date)
            ->where('shift_id', $this->shift_id);

        if ($this->selectedSupervisor != 'Tanpa Supervisor') {
            $attendances = $attendances->whereHas('employee.group.supervisor', function ($query) use ($supervisor) {
                $query->where('name', $supervisor);
            });
        } else {
            $attendances = $attendances->whereHas('employee', function ($query) {
                $query->where('group_id', null);
            });
        }

        if ($this->selectedDivision != '-') {
            $attendances = $attendances->whereHas('employee.position', function ($query) {
                if ($this->selectedDivision != '-') {
                    $query->where('name', $this->selectedDivision);
                }
            });
        } else {
            $attendances = $attendances->whereHas('employee', function ($query) {
                $query->where('position_id', null);
            });
        }

        $attendances = $attendances->get();

        // Filter berdasarkan kategori yang sedang dipilih
        $filterFunction = match ($this->selectedCategory) {
            'IN' => fn($attendance) => $this->isIn($attendance),
            'OUT' => fn($attendance) => $this->isOut($attendance),
            'BreakIn' => fn($attendance) => $this->isBreakIn($attendance),
            'BreakOut' => fn($attendance) => $this->isBreakOut($attendance),
            default => fn($attendance) => false,
        };

        // Hanya ambil attendance yang sesuai dengan kategori
        $filteredAttendances = $attendances->filter($filterFunction);

         // Buat data unik berdasarkan employee_id agar tidak ada duplikasi && get data attendance dan nama employeenya
         $this->employeeData = $filteredAttendances->unique('employee_id')->map(function ($attendance) {
            return [
                'name' => $attendance->employee->name,
                'phone' => $attendance->employee->phone,
                'timestamp' => $attendance->timestamp
            ];
        });
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedCategory = '';
        $this->selectedDivision = '';
        $this->supervisorData = [];
        $this->selectedSupervisor = '';
        $this->employeeData = [];
    }

    // Cek apakah waktu sesuai dengan kategori 'IN'
    private function isIn($attendance)
    {
        $time = Carbon::parse($attendance->timestamp);
        $shift = $attendance->shift;
        $start_adjustment = Carbon::parse($shift->start_adjustment)->setDateFrom(Carbon::parse($attendance->shift_date));
        $break_start = Carbon::parse($shift->break_start_time)->setDateFrom(Carbon::parse($attendance->shift_date));

        if ($break_start->hour < $start_adjustment->hour) {
            $break_start->addDay();
        }

        return $time->between($start_adjustment, $break_start);
    }

    // Cek apakah waktu sesuai dengan kategori 'BreakIn'
    private function isBreakIn($attendance)
    {
        $time = Carbon::parse($attendance->timestamp);
        $shift = $attendance->shift;
        $break_start = Carbon::parse($shift->break_start_time)
            ->setDateFrom(Carbon::parse($attendance->shift_date));
        $break_end = Carbon::parse($shift->break_end_time)
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
        $shift = $attendance->shift;
        $break_end = Carbon::parse($shift->break_end_time)
            ->setDateFrom(Carbon::parse($attendance->shift_date))->addDay();
        $end_time = Carbon::parse($shift->end_time)
            ->setDateFrom(Carbon::parse($attendance->shift_date))->addDay();

        return $time->between($break_end, $end_time);
    }

    // Cek apakah waktu sesuai dengan kategori 'OUT'
    private function isOut($attendance)
    {
        $time = Carbon::parse($attendance->timestamp);
        $shift = $attendance->shift;
        $end_time = Carbon::parse($shift->end_time)
            ->setDateFrom(Carbon::parse($attendance->shift_date))->addDay();
        $end_adjustment = Carbon::parse($shift->end_adjustment)
            ->setDateFrom(Carbon::parse($attendance->shift_date))->addDay();

        return $time->between($end_time, $end_adjustment);
    }

    #[On('updatedData')]
    public function updatedDate($date)
    {
        $this->date = $date;

        $this->dateString = Carbon::parse($date)->format('d F Y');

        $this->shift = Shift::where('day_of_week', strtolower(Carbon::parse($this->date)->format('l')))->skip(1)->first();
        $this->shift_id = $this->shift->id;

        $this->generateAttendance();
    }
    public function render()
    {
        return view('livewire.dashboard.attendance-per-position-night');
    }
}
