<?php

namespace App\Livewire\Activity;

use App\Models\StatusActivity;
use App\Models\User;
use App\Models\Group;
use App\Models\Scope;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Position;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;

class ActivityList extends Component
{
    use LivewireAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(except: '')]

    public $search = '';
    public $perPage = 30;

    public $filterGroup = '';
    public $filterScope = '';
    public $filterPosition = '';
    public $filterDate = '';
    public $filterSupervisor = '';

    public $groups = [];
    public $positions = [];
    public $scopes = [];
    public $supervisors = [];

    public $activity_id = '';

    public $statuses = [];
    public $status_id = '';
    public $progress = 0;


    protected $listeners = [
        'refreshIndex' => 'handleRefresh',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        $this->groups = Group::all();
        $this->positions = Position::all();
        $this->scopes = Scope::all();
        $this->supervisors = User::role('Supervisor')->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function handleRefresh()
    {
        $this->alert('success', 'Refreshed successfully');
        $this->dispatch('$refresh');
    }

    public function resetFilter()
    {
        $this->search = "";
        $this->filterGroup = "";
        $this->filterScope = "";
        $this->filterPosition = "";
        $this->filterDate = "";
        $this->filterSupervisor = "";

        $this->resetPage();
    }

    public function filter()
    {
        $this->resetPage();
        $this->dispatch('$refresh');
    }

    #[On('show-modal-validation')]
    public function validationActivity($activity_id)
    {
        $this->activity_id = $activity_id;

        $this->statuses = StatusActivity::all();
        $this->dispatch('showFormValidation');
    }

    public function submitValidation()
    {
        $this->validate([
            'activity_id' => 'required',
            'status_id' => 'required',
        ]);

        try {

            $activity = Activity::find($this->activity_id);
            $activity->status_id = $this->status_id;
            $activity->save();

            $this->alert('success', 'Status updated successfully');
            $this->dispatch('hideFormValidation');
            return redirect()->route('activity');
        } catch (\Exception $e) {
            $this->alert('error', 'Status could not be updated');
        }
    }

    #[On('show-modal-progress')]
    public function updateProgress($activity_id)
    {
        $this->activity_id = $activity_id;
        $this->dispatch('showFormProgress');
    }

    public function submitProgress()
    {
        $this->validate([
            'activity_id' => 'required',
            'progress' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $activity = Activity::find($this->activity_id);
            $activity->update([
                'progress' => $this->progress
            ]);

            $activity->historyProgress()->create([
                'percentage' => $this->progress,
                'user_id' => auth()->user()->id,
            ]);

            DB::commit();

            // Save/update progress here
            $this->alert('success', 'Progress updated to ' . $this->progress . '%');
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
        $activities = Activity::with('group', 'scope', 'issues', 'supervisor', 'position', 'historyProgress', 'status')
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterGroup, function ($query) {
                return $query->where('group_id', $this->filterGroup);
            })
            ->when($this->filterScope, function ($query) {
                return $query->where('scope_id', $this->filterScope);
            })
            ->when($this->filterPosition, function ($query) {
                return $query->where('position_id', $this->filterPosition);
            })
            ->when($this->filterDate, function ($query) {
                return $query->where('date', $this->filterDate);
            })
            ->when($this->filterSupervisor, function ($query) {
                return $query->where('supervisor_id', $this->filterSupervisor);
            })
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('livewire.activity.activity-list', compact('activities'));
    }
}
