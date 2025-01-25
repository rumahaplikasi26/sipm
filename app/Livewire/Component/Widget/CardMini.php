<?php

namespace App\Livewire\Component\Widget;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class CardMini extends Component
{
    #[Reactive]
    public $title;

    #[Reactive]
    public $value;

    public function mount($title, $value)
    {
        $this->title = $title;
        $this->value = $value;
    }

    public function render()
    {
        return view('livewire.component.widget.card-mini');
    }
}
