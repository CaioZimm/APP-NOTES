<?php

namespace App\Livewire\Password;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use App\Services\PasswordResetService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Masmerise\Toaster\Toaster;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\User;

class ConfirmationNewPassword extends Component
{
    public $token;
    public $newpassword, $newpassword_confirmation;

    public function render()
    {
        return view('livewire.password.confirmation-new-password');
    }

    public function resetNewPassword(Request $request){
        $this->validate([
            'token' => ['required', 'max:6', 'min:6'],
            'newpassword' => ['required', 'string', 'confirmed', 'max:16', 'min:4'],
        ]);

        $key = 'confirm-password:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            Toaster::error("Muitas tentativas. Tente novamente em {$seconds} segundos.");
            return;
        }

        RateLimiter::hit($key, 60 * 5);

        $email = session('reset_email');
        if (!$email) {
            Toaster::error('Sessão expirada. Tente novamente.');
            return Redirect::to('/reset-password');
        }

        $service = new PasswordResetService();
        
        if (!$service->isValidToken($email, $this->token)) {
            Toaster::error('Token inválido ou expirado.');
            return Redirect::to('/new-password');
        }

        $user = User::where('email', $email)->first();

        if (Hash::check($this->newpassword, $user->password)) {
            Toaster::error('A nova senha deve ser diferente da senha atual.');
            return Redirect::to('/new-password');
        }

        $user->update([
            'password' => $this->newpassword,
        ]);
        
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();
        session()->forget('reset_email');
        RateLimiter::clear($key);

        Toaster::success('Senha redefinida com sucesso!');
        return Redirect::to('/login');
    }
}