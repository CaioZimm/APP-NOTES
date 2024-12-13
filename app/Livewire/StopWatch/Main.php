<?php

namespace App\Livewire\StopWatch;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Main extends Component
{
    public $screen = 'timer';

    public function timer(){
        $this->screen = $this->screen === 'timer' ? 'timer' : 'timer';
    }
    public function stopwatch(){
        $this->screen = $this->screen === 'stopwatch' ? 'stopwatch' : 'stopwatch';
    }
    public function render()
    {
        return view('livewire.stop-watch.main');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->redirect('/', navigate:true);
    }
}
