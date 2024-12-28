<?php

namespace App\Livewire\Password;

use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ResetPassword extends Component
{
    public $email;

    public function render()
    {
        return view('livewire.password.reset-password');
    }

    public function resetPassword(Request $request){
        $this->validate([
            'email' => ['required', 'email', 'exists:users'],
        ]);

        $user = User::where('email', $this->email)->first();

        if(!$user){
            Toaster::error('Erro ao enviar o código para seu email');
            return Redirect::to('/reset-password');
        }

        Mail::to($user)->send(new ForgotPassword($user));

        Toaster::success('Código enviado para o email informado.');
        return redirect()->to('/new-password');
    }
}