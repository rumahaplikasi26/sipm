<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class DashboardActivity extends Component
{
    public $date;

    public function render()
    {
        return view('livewire.dashboard.dashboard-activity')->layout('layouts.app', ['title' => 'Dashboard Activity']);
    }
}
