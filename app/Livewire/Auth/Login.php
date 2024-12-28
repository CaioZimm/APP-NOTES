<?php

namespace App\Livewire\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login(Request $request){
            $validated = $this->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'max:16', 'min:4'],
            ]);

            if(Auth::attempt($validated)){
                $request->session()->regenerate();

                return $this->redirect('/', navigate:true);
            }

        $this->addError('erro', 'Suas credenciais estão incorretas.');
    }
}
