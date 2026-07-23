<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LiveTimer extends Component
{
    public $timezone, $currentTime;

    public function mount(){
        $this->timezone = Auth::user()->timezone ?? 'America/Sao_Paulo';
        $this->currentTime = now()->setTimezone($this->timezone)->format('H:i:s');
    }

    public function render()
    {
        return view('livewire.live-timer');
    }
}
