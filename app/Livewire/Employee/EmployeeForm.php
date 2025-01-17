<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class EmployeeForm extends Component
{
    use LivewireAlert;
    public $name, $email, $employee_id, $phone, $group, $position, $positions, $groups, $mode = 'create';
    public $employee;

    public function mount()
    {
        $this->positions = \App\Models\Position::all();
        $this->groups = \App\Models\Group::all();
    }

    #[On('employee-edit')]
    public function edit(Employee $employee)
    {
        $this->employee = $employee;
        $this->name = $employee->name;
        $this->employee_id = $employee->id;
        $this->email = $employee->email;
        $this->group = $employee->group_id;
        $this->position = $employee->position_id;
        $this->phone = $employee->phone;

        $this->mode = 'edit';
    }

    public function submit()
    {
        $this->validate([
            'employee_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'position' => 'nullable',
            'group' => 'nullable',
        ]);

        try {
            switch ($this->mode) {
                case 'create':
                    $employee = Employee::create([
                        'id' => $this->employee_id,
                        'name' => $this->name,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'position_id' => $this->position,
                        'group_id' => $this->group,
                    ]);

                    break;
                case 'edit':
                    $this->employee->update([
                        'id' => $this->employee_id,
                        'name' => $this->name,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'position_id' => $this->position,
                        'group_id' => $this->group,
                    ]);

                    break;
            }

            $this->alert('success', 'Employee ' . ($this->mode == 'create' ? 'created' : 'updated') . ' successfully');
            $this->resetForm();
            $this->dispatch('refreshIndex');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset('name', 'email', 'phone', 'group', 'position', 'employee_id');
        $this->mode = 'create';
    }

    public function render()
    {
        return view('livewire.employee.employee-form');
    }
}
