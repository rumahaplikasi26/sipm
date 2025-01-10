<?php

namespace App\Livewire\Group;

use App\Models\Group;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Str;

class GroupForm extends Component
{
    use LivewireAlert;

    public $mode = 'create';
    public $name, $slug, $group;

    #[On('group-edit')]
    public function edit(Group $group)
    {
        $this->group = $group;
        $this->name = $group->name;

        $this->mode = 'edit';
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $this->slug = Str::slug($this->name);

        try {
            switch ($this->mode) {
                case 'create':
                    Group::create([
                        'name' => $this->name,
                        'slug' => $this->slug,
                    ]);
                    break;
                default:
                    $this->group->update([
                        'name' => $this->name,
                        'slug' => $this->slug,
                    ]);
                    break;
            }

            $this->alert('success', 'Group saved successfully');
            $this->resetForm();
            $this->dispatch('refreshIndex');
        } catch (\Exception $e) {
            $this->alert('error', 'Group could not be saved');
        }
    }

    public function resetForm()
    {
        $this->name = '';
        $this->slug = '';
        $this->group = null;
        $this->mode = 'create';
    }

    public function render()
    {
        return view('livewire.group.group-form');
    }
}
