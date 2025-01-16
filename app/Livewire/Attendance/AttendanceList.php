<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceList extends Component
{
    use LivewireAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(except: '')]

    public $search = '';
    public $perPage = 30;

    public $filterGroup = '';
    public $filterPosition = '';
    public $filterStartDate = '';
    public $filterEndDate = '';

    public $groups = [];
    public $positions = [];

    protected $listeners = [
        'refreshIndex' => 'handleRefresh',
        'refreshList' => 'handleRefresh',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function resetForm()
    {
        $this->search = '';
        $this->filterGroup = '';
        $this->filterPosition = '';
        $this->filterStartDate = '';
        $this->filterEndDate = '';
    }

    public function handleRefresh()
    {
        $this->dispatch('$refresh');
    }

    public function mount()
    {
        $this->groups = \App\Models\Group::all();
        $this->positions = \App\Models\Position::all();
    }

    public function render()
    {
        $attendances = Attendance::with('employee.group', 'employee.position')->when($this->search, function ($query) {
            $query->whereHas('employee', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
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
