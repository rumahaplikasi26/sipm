<?php

namespace App\Livewire\MonitoringPresent;

use App\Livewire\BaseComponent;
use App\Models\Employee;
use App\Models\Shift;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class MonitoringPresentForm extends BaseComponent
{
    public $employees, $shifts;
    public $user_id, $shift_id, $datetime, $type, $group_id, $role;
    public $is_presents = [];
    public $search = '';
    public $groups;

    protected $queryString = ['search' => ['except' => '']];

    public function updatedSearch()
    {
        if ($this->authUser->hasRole('Supervisor')) {
            $this->employees = Employee::with('group')->whereHas('group', function ($query) {
                $query->where('supervisor_id', $this->authUser->id);
            })
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $this->employees = Employee::with('group')
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->get();
        }
    }

    public function submitMonitoringPresent()
    {
        dd($this->is_presents);
    }

    public function mount()
    {
        if ($this->authUser->hasRole('Supervisor')) {
            $this->employees = Employee::with('group')->whereHas('group', function ($query) {
                $query->where('supervisor_id', $this->authUser->id);
            })->get();
        } else {
            $this->employees = Employee::with('group')->get();
        }

        $this->groups = \App\Models\Group::all();
        $this->shifts = Shift::all();
        // $this->shifts = Shift::where('day_of_week', Carbon::now()->dayOfWeek)->get();
    }

    public function render()
    {
        return view('livewire.monitoring-present.monitoring-present-form');
    }
}
