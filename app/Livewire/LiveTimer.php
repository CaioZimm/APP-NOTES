<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LiveTimer extends Component
{
    public $timezone, $currentTime;

    public function mount(){
        $this->timezone = Auth::user()->timezone ?? 'America/Sao_Paulo';
        $this->update();
    }

    public function update(){
        $this->currentTime = now()->setTimezone($this->timezone)->format('H:i:s');
    }

    public function render()
    {
        return view('livewire.live-timer');
    }
}
