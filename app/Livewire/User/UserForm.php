<?php

namespace App\Livewire\User;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class UserForm extends Component
{
    use LivewireAlert;
    public $name, $email, $password, $selectedRoles = [], $selectedPermissions = [], $roles, $permissions, $mode = 'create';
    public $user;

    public function mount()
    {
        $this->roles = \Spatie\Permission\Models\Role::all();
        $this->permissions = \Spatie\Permission\Models\Permission::all();
    }

    #[On('user-edit')]
    public function edit(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRoles = $user->roles()->pluck('name')->toArray();
        $this->selectedPermissions = $user->permissions()->pluck('name')->toArray();
        $this->mode = 'edit';
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable',
            'selectedRoles' => 'required',
            'selectedPermissions' => 'required',
        ]);

        try {
            if ($this->mode == 'create') {
                $user = \App\Models\User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => bcrypt($this->password),
                ]);

                $user->assignRole($this->selectedRoles);
                $user->givePermissionTo($this->selectedPermissions);
            } else {
                if($this->password == null) {
                    $this->password = $this->user->password;
                } else {
                    $this->password = bcrypt($this->password);
                }

                $this->user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => $this->password,
                ]);

                $this->user->syncRoles($this->selectedRoles);
                $this->user->syncPermissions($this->selectedPermissions);
            }

            $this->alert('success', 'User ' . ($this->mode == 'create' ? 'created' : 'updated') . ' successfully');
            $this->reset('name', 'email', 'password', 'selectedRoles', 'selectedPermissions');
            $this->dispatch('refreshIndex');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset('name', 'email', 'password', 'selectedRoles', 'selectedPermissions');
        $this->mode = 'create';
    }

    public function render()
    {
        return view('livewire.user.user-form');
    }
}
