<?php

namespace App\Livewire\Report;

use App\Models\Activity;
use App\Models\User;
use App\Models\Group;
use App\Models\Scope;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Position;

class ReportIndex extends Component
{
    use LivewireAlert;

    public $search = '';
    public $perPage = 30;

    public $filterGroup = '';
    public $filterScope = '';
    public $filterPosition = '';
    public $filterDate = '';
    public $filterSupervisor = '';

    public $groups = [];
    public $positions = [];
    public $scopes = [];
    public $supervisors = [];
    public $activities = [];

    protected $listeners = [
        'refreshIndex' => 'handleRefresh',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        $this->groups = Group::all();
        $this->positions = Position::all();
        $this->scopes = Scope::all();
        $this->supervisors = User::role('Supervisor')->get();
    }

    public function resetFilter()
    {
        $this->search = "";
        $this->filterGroup = "";
        $this->filterScope = "";
        $this->filterPosition = "";
        $this->filterDate = "";
        $this->filterSupervisor = "";

        $this->activities = [];
    }

    public function filter()
    {
        $this->activities = Activity::with('group', 'scope', 'historyProgress','status', 'issues.categoryDependency','supervisor', 'position')
        ->with(['historyProgress' => function ($query) {
            $query->orderBy('date', 'asc');
        }])
        ->when($this->search, function ($query) {
            return $query->whereHas('scope', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->filterGroup, function ($query) {
            return $query->where('group_id', $this->filterGroup);
        })
        ->when($this->filterPosition, function ($query) {
            return $query->where('position_id', $this->filterPosition);
        })
        ->when($this->filterDate, function ($query) {
            return $query->whereHas('issues', function ($query) {
                $query->where('date', $this->filterDate);
            })->orWhereHas('historyProgress', function ($query) {
                $query->where('date', $this->filterDate);
            });
        })
        ->when($this->filterSupervisor, function ($query) {
            return $query->where('supervisor_id', $this->filterSupervisor);
        })
        ->orderBy('id', 'asc')
        ->get()->toArray();

        if(empty($this->activities)) {
            $this->alert('warning', 'Data Not Found');
        }

        $this->dispatch('refreshActivities', $this->activities);
    }

    public function render()
    {
        return view('livewire.report.report-index')->layout('layouts.app', ['title' => 'Report Activity']);
    }
}
