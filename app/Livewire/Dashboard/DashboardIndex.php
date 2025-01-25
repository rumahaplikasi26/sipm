<?php

namespace App\Livewire\Dashboard;

use App\Models\Shift;
use Carbon\Carbon;
use Livewire\Component;

class DashboardIndex extends Component
{
    public $date;
    public $shifts;
    public $shift_id;

    public function mount()
    {
        $this->date =Carbon::today()->format('Y-m-d');
        $this->shifts = Shift::where('day_of_week', Carbon::today()->dayOfWeek)->get();
        $this->shift_id = $this->shifts->first()->id;
    }
    
    public function updatedDate($value)
    {
        $this->shifts = Shift::where('day_of_week', Carbon::parse($this->date)->dayOfWeek)->get();
        $this->dispatch('updatedData', $this->date, $this->shifts->first()->id);
    }

    public function updatedShiftId($value)
    {
        $this->dispatch('updatedData', $this->date, $this->shift_id);
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-index')->layout('layouts.app', ['title' => 'Dashboard']);
    }
}
