<?php

namespace App\Livewire\Password;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use App\Services\PasswordResetService;
use Illuminate\Support\Facades\Mail;
use Masmerise\Toaster\Toaster;
use Illuminate\Http\Request;
use App\Mail\ForgotPassword;
use Livewire\Component;
use App\Models\User;

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

        $key = 'reset-password:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            Toaster::error("Muitas tentativas. Tente novamente em {$seconds} segundos.");
            return;
        }

        RateLimiter::hit($key, 60 * 5);

        $user = User::where('email', $this->email)->first();

        if(!$user){
            Toaster::error('Erro ao enviar o código para seu email');
            return Redirect::to('/reset-password');
        }

        $token = (new PasswordResetService())->createToken($user->email);
        
        session()->put('reset_email', $user->email);
        Mail::to($user)->send(new ForgotPassword($token, $user->email));

        Toaster::success('Código enviado para o email informado.');
        return redirect()->to('/new-password');
    }
}