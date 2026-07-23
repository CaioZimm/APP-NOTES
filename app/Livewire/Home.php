<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\HasLogout;
use Livewire\Component;

class Home extends Component
{
    use HasLogout;

    public function render()
    {
        return view('livewire.home');
    }
}
