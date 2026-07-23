<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toaster;
use Illuminate\Http\Request;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember;

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login(){
            $this->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'max:16', 'min:4'],
            ]);

            if(Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
                session()->regenerate();

                return $this->redirect('/', navigate:true);
            }

        Toaster::error('Suas credenciais estão incorretas.');
        return Redirect::to('/login');
    }
}
