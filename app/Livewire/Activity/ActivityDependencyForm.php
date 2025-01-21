<?php

namespace App\Livewire\Activity;

use App\Models\ActivityIssue;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ActivityDependencyForm extends Component
{
    use LivewireAlert;
    public $activity_id;
    public $dependencies = []; // Array untuk menyimpan input
    public $category_dependencies = []; // Data category dependencies
    public $deletedIds = []; // Track IDs of deleted dependencies

    protected $rules = [
        'dependencies.*.id' => 'nullable|exists:activity_issues,id',
        'dependencies.*.category_dependency_id' => 'required|exists:category_dependencies,id',
        'dependencies.*.percentage_dependency' => 'required|numeric|min:0|max:100',
        'dependencies.*.percentage_solution' => 'required|numeric|min:0|max:100',
        'dependencies.*.description' => 'required|string|max:255',
    ];

    public function mount()
    {
        // Ambil data category dependencies (contoh)
        $this->category_dependencies = \App\Models\CategoryDependency::all();
    }

    public function addDependency()
    {
        $this->dependencies[] = [
            'id' => '',
            'category_dependency_id' => '',
            'description' => ''
        ];
    }

    public function removeDependency($index)
    {
        // If the dependency has an ID, add it to deletedIds array
        if (isset($this->dependencies[$index]['id'])) {
            $this->deletedIds[] = $this->dependencies[$index]['id'];
        }

        unset($this->dependencies[$index]);
        $this->dependencies = array_values($this->dependencies);
    }

    #[On('show-canvas-dependency')]
    public function showModal($activity_id)
    {
        $this->activity_id = $activity_id;
        // dd($this->activity_id);
        $this->dependencies = ActivityIssue::where('activity_id', $this->activity_id)
            ->get()
            ->map(function ($issue) {
                return [
                    'id' => $issue->id,
                    'category_dependency_id' => $issue->category_dependency_id ?? null, // default jika null
                    'description' => $issue->description ?? null, // default jika null
                    'percentage_dependency' => $issue->percentage_dependency ?? null, // default jika null
                    'percentage_solution' => $issue->percentage_solution ?? null, // default jika null
                ];
            })
            ->toArray();

        $this->dispatch('showFormDependency');
    }

    public function resetForm()
    {
        $this->dependencies = [
            ['id' => '', 'category_dependency_id' => '', 'description' => '', 'percentage_dependency' => '', 'percentage_solution' => '']
        ];
        $this->deletedIds = [];

        $this->resetValidation();
    }

    #[On('hide-modal-dependency')]
    public function hideModal()
    {
        $this->dispatch('hideModalDependency');
    }

    public function submit()
    {
        $this->validate();

        try {
            // Delete removed dependencies
            if (!empty($this->deletedIds)) {
                ActivityIssue::whereIn('id', $this->deletedIds)->delete();
            }

            foreach ($this->dependencies as $dependency) {
                if (!empty($dependency['id'])) {
                    // Update existing dependency
                    ActivityIssue::find($dependency['id'])->update([
                        'category_dependency_id' => $dependency['category_dependency_id'],
                        'description' => $dependency['description'],
                        'percentage_dependency' => $dependency['percentage_dependency'],
                        'percentage_solution' => $dependency['percentage_solution'],
                    ]);
                } else {
                    // Create new dependency
                    ActivityIssue::create([
                        'activity_id' => $this->activity_id,
                        'category_dependency_id' => $dependency['category_dependency_id'],
                        'description' => $dependency['description'],
                        'percentage_dependency' => $dependency['percentage_dependency'],
                        'percentage_solution' => $dependency['percentage_solution'],
                    ]);
                }
            }

            $this->alert('success', 'Dependency saved successfully');
            $this->resetForm();
            return redirect(route('activity'));
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }

        $this->dispatch('hideModalDependency');
    }

    public function render()
    {
        return view('livewire.activity.activity-dependency-form');
    }
}
