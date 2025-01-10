<?php

namespace App\Livewire\Activity;

use App\Models\Activity;
use App\Models\Group;
use App\Models\Position;
use App\Models\Scope;
use App\Models\User;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ActivityForm extends Component
{
    use LivewireAlert;
    public $mode = 'create';
    public $date, $title, $slug, $group_id, $position_id, $scope_id, $total_estimate, $type_estimate, $forecast_date, $plan_date, $actual_date, $supervisor_id, $description;

    public $positions, $scopes, $groups, $supervisors;

    public function mount()
    {
        $this->groups = Group::all();
        $this->positions = Position::all();
        $this->scopes = Scope::all();
        $this->supervisors = User::role('Supervisor')->get();
    }

    public function submit()
    {
        $this->validate([
            'date' => 'required|date',
            'title' => 'required',
            'group_id' => 'required',
            'position_id' => 'required',
            'scope_id' => 'required',
            'total_estimate' => 'required|numeric',
            'type_estimate' => 'required',
            'forecast_date' => 'required|date',
            'plan_date' => 'required|date',
            'actual_date' => 'required|date',
            'supervisor_id' => 'required',
            'description' => 'nullable',
        ]);

        try {
            $activity = Activity::create([
                'date' => $this->date,
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'group_id' => $this->group_id,
                'position_id' => $this->position_id,
                'scope_id' => $this->scope_id,
                'total_estimate' => $this->total_estimate,
                'type_estimate' => $this->type_estimate,
                'forecast_date' => $this->forecast_date,
                'plan_date' => $this->plan_date,
                'actual_date' => $this->actual_date,
                'supervisor_id' => $this->supervisor_id,
                'description' => $this->description,
            ]);

            $this->alert('success', 'Activity saved successfully', ['position' => 'top-center']);
            $this->resetForm();
            $this->dispatch('refreshIndex');
            $this->dispatch('hideForm');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage(), ['position' => 'top-center']);
        }
    }

    public function resetForm()
    {
        $this->date = null;
        $this->title = null;
        $this->slug = null;
        $this->group_id = null;
        $this->position_id = null;
        $this->scope_id = null;
        $this->total_estimate = null;
        $this->type_estimate = null;
        $this->forecast_date = null;
        $this->plan_date = null;
        $this->actual_date = null;
        $this->supervisor_id = null;
        $this->description = null;
    }

    public function render()
    {
        return view('livewire.activity.activity-form');
    }
}
