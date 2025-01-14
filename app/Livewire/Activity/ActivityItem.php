<?php

namespace App\Livewire\Activity;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ActivityItem extends Component
{
    use LivewireAlert;

    public $activity;
    public $number;
    public $activity_id;
    public $progress = 0;

    public function mount($activity, $number)
    {
        $this->activity = $activity;
        $this->number = $number;
    }

    public function confirmProgress()
    {
        $this->activity_id = $this->activity->id;
        $this->progress = $this->activity->progress;

        $this->alert('question', 'Update Progress', [
            'position' => 'center',
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancel',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Update',
            'input' => 'range',
            'inputAttributes' => [
                'min' => 0,
                'max' => 100,
                'step' => 1,
            ],
            'inputValue' => $this->progress,
            'inputPlaceholder' => 'Progress',
            'action' => 'updateProgress',
            'allowOutsideClick' => false,
            'onConfirmed' => 'updateProgress',
            'timer' => null,
        ]);
    }

    #[On('updateProgress')]
    public function updateProgress($value, $isConfirmed, $isDenied, $isDismissed, $data)
    {
        $this->progress = $value;

        try {
            DB::beginTransaction();

            $this->activity->update([
                'progress' => $this->progress,
            ]);

            $this->activity->historyProgress()->create([
                'percentage' => $this->progress,
                'user_id' => auth()->user()->id,
            ]);

            DB::commit();

            // Save/update progress here
            $this->alert('success', 'Progress updated to ' . $this->progress . '%');
            $this->dispatch('refreshIndex');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
            return;
        }

    }

    public function confirmDelete()
    {
        $this->alert('warning', 'Are you sure you want to delete this activity?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'position' => 'center',
            'showDenyButton' => true,
            'denyButtonText' => 'No, cancel!',
            'timer' => null,
            'toast' => false,
            'activity' => 'center',
            'timerProgressBar' => true,
            'onConfirmed' => 'activity-delete',
            'onDenied' => 'cancelled',
        ]);
    }

    #[On('activity-delete')]
    public function delete()
    {
        try {
            $this->activity->delete();
            $this->alert('success', 'Activity deleted successfully');
            $this->dispatch('refreshIndex');
        } catch (\Exception $e) {
            $this->alert('error', 'Activity could not be deleted');
        }
    }

    public function render()
    {
        return view('livewire.activity.activity-item');
    }
}
