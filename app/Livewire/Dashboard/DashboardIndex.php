<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use Livewire\Component;

class DashboardIndex extends Component
{
    public $date;

    public function mount()
    {
        $this->date =Carbon::today()->format('Y-m-d');
    }
    
    public function updatedDate($value)
    {
        $this->dispatch('updatedData', $this->date);
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-index')->layout('layouts.app', ['title' => 'Dashboard']);
    }
}
