<?php

namespace App\Livewire\Password;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ConfirmationNewPassword extends Component
{
    public $token;
    public $newpassword, $newpassword_confirmation;

    public function render()
    {
        return view('livewire.password.confirmation-new-password');
    }

    public function resetNewPassword(){
        $this->validate([
            'token' => ['required', 'max:6', 'min:6'],
            'newpassword' => ['required', 'string', 'confirmed', 'max:16', 'min:4'],
        ]);

        $verify = DB::table('password_reset_tokens')->where('token', $this->token)->first();

        if (!$verify) {
            Toaster::error('Token inválido ou expirado.');
            return Redirect::to('/new-password');
        }

        $user = User::where('email', $verify->email)->first();

        if (Hash::check($this->newpassword, $user->password)) {
            Toaster::error('A nova senha deve ser diferente da senha atual.');
            return Redirect::to('/new-password');
        }

        $user->update([
            'password' => bcrypt($this->newpassword),
        ]);
        
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        Toaster::success('Senha redefinida com sucesso!');
        return Redirect::to('/login');
    }
}