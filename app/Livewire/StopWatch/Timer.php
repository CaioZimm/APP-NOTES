<?php

namespace App\Livewire\StopWatch;

use Livewire\Component;

class Timer extends Component
{
    public $time;
    public $isRun = false;
    public $isPause = false;
    public $formatted;

    public function mount(){
        $this->formatted = $this->formatTime($this->time);
    }
    public function render()
    {
        return view('livewire.stop-watch.timer');
    }

    public function updatedFormatted($value)
    {
        $value = trim($value);

        if (is_numeric($value)) {
            $this->time = (int) $value;
            $this->formatted = $this->formatTime($this->time);

        } else {
            $parts = explode(':', $value);

            if (count($parts) === 3) {
                $hours = (int) $parts[0];
                $minutes = (int) $parts[1];
                $seconds = (int) $parts[2];

                $this->time = ($hours * 3600) + ($minutes * 60) + $seconds;

            } elseif (count($parts) === 2) {
                $minutes = (int) $parts[0];
                $seconds = (int) $parts[1];

                $this->time = ($minutes * 60) + $seconds;
            }
            
            $this->formatted = $this->formatTime($this->time);
        }
    }

    public function start(){
        if (empty($this->time) || $this->time <= 0) {
            $this->time = 300;
            $this->formatted = $this->formatTime($this->time);
        }
    
        $this->isRun = true;
        $this->isPause = false;
        $this->count();
    }
    public function count(){
        if($this->isRun && $this->time > 0){
            $this->time--;
            $this->formatted = $this->formatTime($this->time);
        }
        elseif ($this->time <= 0) {
            $this->isRun = false;
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
        $this->isRun = false;
        $this->isPause = false;
        $this->time = 300;
        $this->formatted = $this->formatTime($this->time);
    }

    public function formatTime($time){
        $hours = floor($time / 3600);
        $time %= 3600;
        $minutes = floor($time / 60);
        $seconds = $time % 60;

        if ($hours > 0) {
            return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds); // Formato HH:MM:SS
        }
        return sprintf("%02d:%02d", $minutes, $seconds); // Formato MM:SS
    }
}