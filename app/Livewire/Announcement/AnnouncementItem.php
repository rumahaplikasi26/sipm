<?php

namespace App\Livewire\Announcement;

use App\Models\Announcement;
use Livewire\Component;

class AnnouncementItem extends Component
{
    public $announcement;

    public function mount(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    public function render()
    {
        return view('livewire.announcement.announcement-item');
    }
}
