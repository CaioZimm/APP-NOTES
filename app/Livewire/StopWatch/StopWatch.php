<?php

namespace App\Livewire\StopWatch;

use Livewire\Component;

class StopWatch extends Component
{
    public $time = 0;
    public $isRun = false;
    public $isPause = false;
    public $formatted;

    public function mount(){
        $this->formatted = $this->formatTime($this->time);
    }
    public function render()
    {
        return view('livewire.stop-watch.stop-watch');
    }

    public function play(){
        $this->isRun = true;
        $this->isPause = false;
        $this->count();
    }
    
    public function count(){
        if($this->isRun){
            $this->time++;
            $this->formatted = $this->formatTime($this->time);
        }
    }
    
    public function pause(){
        $this->isRun = false;
        $this->isPause = true;
    }

    public function return(){
        $this->isRun = true;
        $this->count();
    }

    public function restart(){
        $this->time = 0;
        $this->formatted = $this->formatTime($this->time);
        $this->isRun = false;
        $this->isPause = false;
    }

    public function formatTime($time){
        $min = floor($time / 60);
        $sec = $time % 60;

        return sprintf("%02d:%02d", $min, $sec);
    }
}
