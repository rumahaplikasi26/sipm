<?php

namespace App\Livewire\MonitoringPresent;

use App\Jobs\AbsentNotification;
use App\Livewire\BaseComponent;
use App\Models\Employee;
use App\Models\MonitoringPresent;
use App\Models\Shift;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class MonitoringPresentForm extends BaseComponent
{
    use LivewireAlert;

    public $employees, $shifts, $shiftForms;
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

    public function resetForm()
    {
        $this->is_presents = [];
        $this->shift_id = '';
        $this->datetime = '';
        $this->type = '';
        $this->group_id = '';
        $this->role = '';
    }

    public function submitMonitoringPresent()
    {
        $this->validate([
            'user_id' => 'required',
            'shift_id' => 'required',
            'type' => 'required',
            'group_id' => 'required',
            'is_presents.*' => 'required',
            'role' => 'required'
        ]);

        try {
            $this->datetime = Carbon::now();

            $monitoring = MonitoringPresent::create([
                'user_id' => $this->user_id,
                'shift_id' => $this->shift_id,
                'datetime' => $this->datetime,
                'group_id' => $this->group_id,
                'type' => $this->type,
                'role' => $this->role
            ]);

            foreach ($this->is_presents as $id => $is_present) {
                $monitoring->details()->create([
                    'employee_id' => $id,
                    'is_present' => $is_present
                ]);

                if(!$is_present){
                    $data = [
                        'employee_id' => $id,
                        'date' => $this->datetime,
                        'shift' => $monitoring->shift->name
                    ];
    
                    AbsentNotification::dispatch($data);
                }
            }

            $this->alert('success', 'Data monitoring berhasil disimpan');
            $this->dispatch('refreshIndex');
            $this->dispatch('hideModalAddMonitoring');
            $this->resetForm();
        } catch (\Exception $e) {
            $this->alert('error', 'Data monitoring gagal disimpan');
        }
    }

    public function updatedGroupId()
    {
        if ($this->group_id != "") {
            $employees = Employee::where('group_id', $this->group_id)->get();
        } else {
            $employees = Employee::with('group')
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->get();
        }

        $this->is_presents = [];
        foreach ($employees as $employee) {
            $this->is_presents[$employee->id] = false; // Inisialisasi semua dengan false
        }

        $this->employees = $employees;
    }

    public function mount($groups)
    {
        if ($this->authUser->hasRole('Supervisor')) {
            $this->employees = Employee::with('group')->whereHas('group', function ($query) {
                $query->where('supervisor_id', $this->authUser->id);
            })->get();

            $this->role = 'supervisor';
        } else {
            $this->employees = Employee::with('group')->get();
            $this->role = 'hse';
        }

        foreach ($this->employees as $employee) {
            $this->is_presents[$employee->id] = false; // Inisialisasi semua dengan false
        }

        $this->user_id = $this->authUser->id;
        $this->groups = $groups;
        $this->shiftForms = Shift::where('day_of_week', Carbon::now()->dayOfWeek)->get();
    }

    public function render()
    {
        return view('livewire.monitoring-present.monitoring-present-form');
    }
}
