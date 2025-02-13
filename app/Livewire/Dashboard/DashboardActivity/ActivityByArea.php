<?php

namespace App\Livewire\Dashboard\DashboardActivity;

use App\Models\Activity;
use Livewire\Component;

class ActivityByArea extends Component
{
    public function render()
    {
        $activitiesByArea = Activity::with('area')->groupBy('area_id')
            ->selectRaw('area_id, COUNT(*) as total')
            ->get()
            ->pluck('total', 'area.name');

        return view('livewire.dashboard.dashboard-activity.activity-by-area', compact('activitiesByArea'));
    }
}
