<?php

namespace App\Livewire\ReportAttendance;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use DatePeriod;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ReportAttendancePreview extends Component
{
    use LivewireAlert;
    public $employees;
    public $dateArray;

    #[On('refreshAttendances')]
    public function preview($employees, $dateArray)
    {
        $this->reset('employees');
        $this->employees = $employees;
        $this->dateArray = $dateArray;
    }

    public function render()
    {
        return view('livewire.report-attendance.report-attendance-preview');
    }
}
