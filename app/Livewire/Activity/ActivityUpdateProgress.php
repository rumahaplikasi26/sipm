<?php

namespace App\Livewire\Activity;

use App\Models\Activity;
use App\Models\ActivityDetail;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ActivityUpdateProgress extends Component
{
    use LivewireAlert;

    public $activity_id;
    public $scopes = [];
    public $details;

    public $updateProgress = [];

    #[On('show-modal-progress')]
    public function updateProgress($activity_id)
    {
        $this->activity_id = $activity_id;
        $activity = Activity::with('details.scope')->find($activity_id);
        $this->details = $activity->details->toArray();

        // Initialize progress values for each detail
        foreach ($this->details as $detail) {
            $this->updateProgress[$detail['id']] = $detail['progress'];
        }

        $this->dispatch('showFormProgress');
    }

    public function submitProgress()
    {
        // dd($this->updateProgress);

        $this->validate([
            'activity_id' => 'required',
            'updateProgress.*' => 'required',
        ]);

        try {
            DB::beginTransaction();

            foreach ($this->updateProgress as $detail_id => $progress) {
                ActivityDetail::where('id', $detail_id)->update(['progress' => $progress]);
            }

            $activity = ActivityDetail::where('activity_id', $this->activity_id)->get();
            $totalProgress = $activity->sum('progress');
            $countDetails = $activity->count();
            $averageProgress = $countDetails > 0 ? $totalProgress / $countDetails : 0;

            Activity::where('id', $this->activity_id)->update([
                'progress' => $averageProgress
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
