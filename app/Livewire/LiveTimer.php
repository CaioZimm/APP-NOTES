<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class LiveTimer extends Component
{
    public $time;

    public function mount(){
        $this->time = now()->format('H:i:s');
    }

    public function increment()
    {
        $timeCurrent = Carbon::createFromFormat('H:i:s', $this->time);
        $timeCurrent->addSecond();
        $this->time = $timeCurrent->format('H:i:s');
    }

    public function render()
    {
        return view('livewire.live-timer');
    }
}
