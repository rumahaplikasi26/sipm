<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendance;
use App\Models\AttendanceReference;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class AttendanceGap extends Component
{
    public $date;
    public $shift_id;
    public $dateString;
    public $reference;

    public $gapCheckInOnly = []; // Karyawan yang check-in tetapi tidak check-out
    public $gapCheckOutOnly = []; // Karyawan yang check-out tetapi tidak check-in
    public $totalGapCheckInOnly = 0;
    public $totalGapCheckOutOnly = 0;

    public function mount($date)
    {
        $this->date = $date;
        $this->dateString = Carbon::parse($date)->format('d F Y');
        $this->reference = AttendanceReference::where('day_of_week', strtolower(Carbon::parse($this->date)->format('l')))->first();
        $this->shift_id = $this->reference->id;
        $this->calculateGap();
    }

    #[On('updatedData')]
    public function updatedDate($date)
    {
        $this->date = $date;

        $this->dateString = Carbon::parse($date)->format('d F Y');

        $this->reference = AttendanceReference::where('day_of_week', strtolower(Carbon::parse($this->date)->format('l')))->first();
        $this->shift_id = $this->reference->id;

        $this->calculateGap();
    }

    public function calculateGap()
    {
        $attendances = Attendance::with(['reference', 'employee.group', 'employee.position'])
            ->whereDate('shift_date', $this->date)
            ->where('shift_id', $this->shift_id)
            ->get();
        // Kelompokkan data berdasarkan employee_id
        $groupedAttendances = [];
        foreach ($attendances as $attendance) {
            $employeeId = $attendance->employee_id;
            if (!isset($groupedAttendances[$employeeId])) {
                $groupedAttendances[$employeeId] = [
                    'check_in' => false,
                    'check_out' => false,
                    'employee' => $attendance->employee,
                ];
            }

            // Tentukan apakah absensi termasuk check-in atau check-out berdasarkan waktu referensi
            $attendanceTime = Carbon::parse($attendance->timestamp)->setDateFrom(Carbon::parse($attendance->shift_date));

            $early_in = Carbon::parse($this->reference->early_in)->setDateFrom(Carbon::parse($this->date));
            $in = Carbon::parse($this->reference->in)->setDateFrom(Carbon::parse($this->date));
            $late_in = Carbon::parse($this->reference->late_in)->setDateFrom(Carbon::parse($this->date));

            if($attendanceTime->between($early_in, $late_in)) {
                $groupedAttendances[$employeeId]['check_in'] = true;
            }

            $early_out = Carbon::parse($this->reference->early_out)->setDateFrom(Carbon::parse($this->date));
            $out = Carbon::parse($this->reference->out)->setDateFrom(Carbon::parse($this->date));
            $late_out = Carbon::parse($this->reference->late_out)->setDateFrom(Carbon::parse($this->date));

            if($attendanceTime->between($early_out, $late_out)) {
                $groupedAttendances[$employeeId]['check_out'] = true;
            }
        }

        // Hitung gap
        $this->gapCheckInOnly = [];
        $this->gapCheckOutOnly = [];

        foreach ($groupedAttendances as $employeeId => $data) {
            if ($data['check_in'] && !$data['check_out']) {
                $this->gapCheckInOnly[] = $data['employee'];
            } elseif (!$data['check_in'] && $data['check_out']) {
                $this->gapCheckOutOnly[] = $data['employee'];
            }
        }

        $this->totalGapCheckInOnly = count($this->gapCheckInOnly);
        $this->totalGapCheckOutOnly = count($this->gapCheckOutOnly);
        // dd($this->gapCheckInOnly, $this->gapCheckOutOnly);
    }

    public function render()
    {
        return view('livewire.dashboard.attendance-gap');
    }
}
