<?php

namespace App\Livewire\Attendance;

use App\Livewire\BaseComponent;
use App\Models\Attendance;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceList extends BaseComponent
{
    use LivewireAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(except: '')]

    public $search = '';
    public $perPage = 25;

    public $filterGroup = '';
    public $filterPosition = '';
    public $filterStartDate = '';
    public $filterEndDate = '';
    public $filterEmployee = '';

    public $groups = [];
    public $positions = [];
    public $employees = [];

    protected $listeners = [
        'refreshIndex' => 'handleRefresh',
        'refreshList' => 'handleRefresh',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 30],
        'filterGroup' => ['except' => ''],
        'filterPosition' => ['except' => ''],
        'filterStartDate' => ['except' => ''],
        'filterEndDate' => ['except' => ''],
        'filterEmployee' => ['except' => ''],
    ];

    public function resetFilter()
    {
        $this->search = '';
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

    public function filter()
    {
        $this->resetPage();
        $this->dispatch('$refresh');
    }

    public function render()
    {
        $attendances = Attendance::with('employee.group', 'employee.position')->when($this->search, function ($query) {
            $query->whereHas('employee', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        });

        if($this->authUser->hasRole('Supervisor')) {
            $attendances->whereHas('employee.group', function ($query) {
                $query->where('supervisor_id', $this->authUser->id);
            });
        }

        $attendances = $attendances->when($this->filterEmployee, function ($query) {
            $query->where('employee_id', $this->filterEmployee);
        })->when($this->filterGroup, function ($query) {
            $query->whereHas('employee', function ($query) {
                $query->where('group_id', $this->filterGroup);
            });
        })->when($this->filterPosition, function ($query) {
            $query->whereHas('employee', function ($query) {
                $query->where('position_id', $this->filterPosition);
            });
        })->when($this->filterStartDate, function ($query) {
            $query->where('date', '>=', $this->filterStartDate);
        })->when($this->filterEndDate, function ($query) {
            $query->where('date', '<=', $this->filterEndDate);
        })->latest()->paginate($this->perPage);

        return view('livewire.attendance.attendance-list', compact('attendances'));
    }
}
