<?php

namespace App\Livewire\ReportAttendance;

use App\Models\Attendance;
use Carbon\Carbon;
use Livewire\Component;

class ReportAttendanceIndex extends Component
{
    public $filterGroup = '';
    public $filterPosition = '';
    public $filterStartDate = '';
    public $filterEndDate = '';
    public $filterEmployee = '';

    public $groups = [];
    public $positions = [];
    public $employees = [];

    public $attendances;

    protected $listeners = [
        'refreshIndex' => 'handleRefresh',
        'refreshList' => 'handleRefresh',
    ];

    protected $queryString = [
        'perPage' => ['except' => 30],
        'filterGroup' => ['except' => ''],
        'filterPosition' => ['except' => ''],
        'filterStartDate' => ['except' => ''],
        'filterEndDate' => ['except' => ''],
        'filterEmployee' => ['except' => ''],
    ];

    public function resetFilter()
    {
        $this->filterGroup = '';
        $this->filterPosition = '';
        $this->filterStartDate = '';
        $this->filterEndDate = '';
        $this->filterEmployee = '';
    }

    public function handleRefresh()
    {
        $this->dispatch('$refresh');
    }

    public function mount()
    {
        $this->groups = \App\Models\Group::all();
        $this->positions = \App\Models\Position::all();
        $this->employees = \App\Models\Employee::all();
    }

    public function preview()
    {
        $this->validate([
            'filterStartDate' => 'required',
            'filterEndDate' => 'required',
        ]);

        // Pastikan rentang tanggal tersedia
        $startDate = Carbon::parse($this->filterStartDate);
        $endDate = Carbon::parse($this->filterEndDate);

        // Ambil semua data attendance sesuai filter
        $attendances = Attendance::with('employee')
            ->when($this->filterGroup, function ($query) {
                $query->whereHas('employee.group', function ($query) {
                    $query->where('id', $this->filterGroup);
                });
            })
            ->when($this->filterPosition, function ($query) {
                $query->whereHas('employee.position', function ($query) {
                    $query->where('id', $this->filterPosition);
                });
            })
            ->whereBetween('timestamp', [$startDate, $endDate]) // Filter rentang tanggal
            ->get();

        // Proses data menjadi format yang diinginkan
        $employees = $attendances->groupBy('employee_id')->map(function ($employeeAttendances) use ($startDate, $endDate) {
            $employee = $employeeAttendances->first()->employee; // Ambil data karyawan
            $dates = [];

            // Loop rentang tanggal
            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $formattedDate = $date->format('Y-m-d');

                // Cari attendance pada tanggal ini
                $attendanceOnDate = $employeeAttendances->filter(function ($attendance) use ($formattedDate) {
                    return $attendance->timestamp >= "$formattedDate 00:00:00" &&
                        $attendance->timestamp <= "$formattedDate 23:59:59";
                });

                if ($attendanceOnDate->isNotEmpty()) {
                    // Ambil jam awal (paling kecil) dan jam akhir (paling besar)
                    $startTime = $attendanceOnDate->min('timestamp');
                    $endTime = $attendanceOnDate->max('timestamp');

                    $dates[$formattedDate] = Carbon::parse($startTime)->format('H:i') . ' - ' . Carbon::parse($endTime)->format('H:i');
                } else {
                    $dates[$formattedDate] = '-';
                }
            }

            return [
                'employee_id' => $employee->id,
                'name' => $employee->name,
                'attendance' => $dates,
            ];
        });

        // dd($employees);
        // Kirim data ke frontend
        $this->dispatch('refreshAttendances', $employees);
    }

    public function render()
    {
        return view('livewire.report-attendance.report-attendance-index')->layout('layouts.app', ['title' => 'Report Attendance']);
    }
}
