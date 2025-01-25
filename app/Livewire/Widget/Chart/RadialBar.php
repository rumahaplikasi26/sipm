<?php

namespace App\Livewire\Widget\Chart;

use Livewire\Component;

class RadialBar extends Component
{
    public $chart_id;
    public $labels = [];
    public $height = 200;
    public $series = [];
    public $color = 'rgba(255, 99, 71, 1)';

    public function mount($chart_id, $series, $color = null)
    {
        $this->labels = ['Progress'];
        $this->chart_id = $chart_id;
        $this->series = $series;    

        $this->color = $color;
    }

    public function render()
    {
        return view('livewire.widget.chart.radial-bar');
    }
}
