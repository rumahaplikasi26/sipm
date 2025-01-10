<?php

namespace App\Livewire\Widget\Chart;

use Livewire\Component;

class RadialBar extends Component
{
    public $chart_id;
    public $labels = [];
    public $height = 200;
    public $series = [];

    public function mount($chart_id, $series)
    {
        $this->labels = ['Progress'];
        $this->chart_id = $chart_id;
        $this->series = $series;
    }

    public function render()
    {
        return view('livewire.widget.chart.radial-bar');
    }
}
