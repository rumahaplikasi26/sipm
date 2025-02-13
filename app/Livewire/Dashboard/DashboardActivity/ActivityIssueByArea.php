<?php

namespace App\Livewire\Dashboard\DashboardActivity;

use App\Models\ActivityIssue;
use Livewire\Component;

class ActivityIssueByArea extends Component
{
    public function render()
    {
        // $averageDependencyByArea = ActivityIssue::join('activities', 'activity_issues.activity_id', '=', 'activities.id')
        //     ->groupBy('activities.area_id')
        //     ->selectRaw('activities.area_id, AVG(activity_issues.percentage_dependency) as average_dependency')
        //     ->get()
        //     ->pluck('average_dependency', 'area_id');

        $averageDependencyByArea = ActivityIssue::join('activities', 'activities.id', '=', 'activity_issues.activity_id')
            ->join('areas', 'areas.id', '=', 'activities.area_id')
            ->groupBy('activities.area_id', 'areas.name')
            ->selectRaw('areas.name as area_name, COUNT(activity_issues.id) as total')
            ->get()
            ->pluck('total', 'area_name');

        // dd($averageDependencyByArea);
        return view('livewire.dashboard.dashboard-activity.activity-issue-by-area', compact('averageDependencyByArea'));
    }
}
