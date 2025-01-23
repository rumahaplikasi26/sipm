<?php

namespace App\Livewire\Activity;

use App\Livewire\BaseComponent;
use App\Models\Activity;
use App\Models\ActivityDetail;
use App\Models\ActivityProgress;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ActivityUpdateProgress extends BaseComponent
{
    use LivewireAlert;

    public $activity_id;
    public $scopes = [];
    public $progress;

    public $percentage, $date, $lastProgress;

    #[On('show-modal-progress')]
    public function updateProgress($activity_id)
    {
        $this->activity_id = $activity_id;
        $activity = Activity::with('historyProgress')->find($activity_id);
        $this->progress = $activity->historyProgress->toArray();

        $this->lastProgress = $activity->progress;

        $this->dispatch('showFormProgress');
    }

    public function submitProgress()
    {
        $this->validate([
            'date' => 'required',
            'activity_id' => 'required',
            'percentage' => 'required',
        ]);

        try {
            DB::beginTransaction();

            ActivityProgress::create([
                'activity_id' => $this->activity_id,
                'date' => $this->date,
                'user_id' => $this->authUser->id,
                'percentage' => $this->percentage,
            ]);

            $activity = ActivityProgress::where('activity_id', $this->activity_id)->get();
            $totalProgress = $activity->sum('percentage');

            Activity::where('id', $this->activity_id)->update([
                'progress' => $totalProgress
            ]);

            DB::commit();

            // Save/update progress here
            $this->alert('success', 'Progress updated to database successfully');
            $this->dispatch('hideFormProgress');
            return redirect()->route('activity');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', $e->getMessage());
            $this->dispatch('hideFormProgress');
            return redirect()->route('activity');
        }

    }

    public function render()
    {
        return view('livewire.activity.activity-update-progress');
    }
}
