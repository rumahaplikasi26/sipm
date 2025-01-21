<?php

namespace App\Livewire\MonitoringPresent;

use Livewire\Component;

class MonitoringPresentItem extends Component
{
    public $monitoring_present;

    public function mount($monitoring_present)
    {
        $this->monitoring_present = $monitoring_present;
    }

    public function render()
    {
        return view('livewire.monitoring-present.monitoring-present-item');
    }
}
