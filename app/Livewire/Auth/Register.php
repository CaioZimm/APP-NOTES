<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toaster;
use Livewire\Component;
use App\Models\User;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function render()
    {
        return view('livewire.auth.register');
    }

    public function register(){
        $this->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'max:16', 'min:4'],
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        Auth::login($user);
        event(new Registered($user));

        Toaster::success('Usuário registrado com sucesso!');
        return Redirect::to('/');
    }
}
