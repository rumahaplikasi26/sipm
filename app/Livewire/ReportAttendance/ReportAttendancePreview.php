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

    #[On('refreshAttendances')]
    public function preview($employees)
    {
        $this->reset('employees');
        $this->employees = $employees;
    }

    public function render()
    {
        return view('livewire.report-attendance.report-attendance-preview');
    }
}
