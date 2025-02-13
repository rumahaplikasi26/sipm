<?php

namespace App\Livewire\Dashboard\DashboardActivity;

use App\Models\Activity;
use Livewire\Component;

class DelayedActivity extends Component
{
    public function render()
    {
        $late = Activity::late()->count();
        $on_time = Activity::onTime()->count();
        $in_progress = Activity::inProgress()->count();

        // dd($late, $on_time);

        return view('livewire.dashboard.dashboard-activity.delayed-activity', compact('late', 'on_time', 'in_progress'));
    }
}
