<?php

namespace App\Livewire\Dashboard\DashboardActivity;

use App\Models\Activity;
use Livewire\Component;

class ActivityByStatus extends Component
{
    public function render()
    {
        // Data untuk Pie Chart (Aktivitas per Status)
        $activitiesByStatus = Activity::with('status')->groupBy('status_id')
            ->selectRaw('status_id, COUNT(*) as total')
            ->get()
            ->pluck('total', 'status.name');

        return view('livewire.dashboard.dashboard-activity.activity-by-status', compact('activitiesByStatus'));
    }
}
