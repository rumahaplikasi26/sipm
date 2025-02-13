<?php

namespace App\Livewire\Dashboard\DashboardActivity;

use App\Models\ActivityIssue;
use Livewire\Component;

class ActivityIssueResolved extends Component
{
    public function render()
    {
        $solved = ActivityIssue::solved()->count();
        $unsolved = ActivityIssue::unsolved()->count();

        return view('livewire.dashboard.dashboard-activity.activity-issue-resolved', compact('solved', 'unsolved'));
    }
}
