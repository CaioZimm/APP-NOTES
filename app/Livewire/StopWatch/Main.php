<?php

namespace App\Livewire\StopWatch;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\HasLogout;
use Livewire\Component;

class Main extends Component
{
    use HasLogout;
    public $screen = 'timer';

    public function timer(){
        $this->screen = 'timer';
    }

    public function stopwatch(){
        $this->screen = 'stopwatch';
    }

    public function render()
    {
        return view('livewire.stop-watch.main');
    }
}