<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Masmerise\Toaster\Toaster;
use Illuminate\Http\Request;
use App\Traits\HasLogout;
use Livewire\Component;
use App\Models\User;

class ProfileUser extends Component
{
    use HasLogout;
    public $user, $name, $email, $timezone;
    public $password, $new_password, $new_password_confirmation;

    public function mount(){
        $this->user = Auth::user();
        $this->timezone = $this->user->timezone;
    }

    public function render()
    {
        return view('livewire.profile.profile-user');
    }

    public function update(){
        $this->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
        ]);

        $data = [];
        if ($this->name && $this->name !== $this->user->name) {
            $data['name'] = $this->name;
        }
        if ($this->email && $this->email !== $this->user->email) {
            $data['email'] = $this->email;
        }
        if (empty($data)) {
            return;
        }

        $this->user->update($data);
        $this->user->refresh();

        $this->reset(['name', 'email']);
        Toaster::success('Informações atualizadas com sucesso!');
    }

    public function updatePassword(){
        $this->validate([
            'password' => ['required', 'max:16', 'min:4'],
            'new_password' => ['required', 'confirmed', 'max:16', 'min:4'],
        ]);

        if (!Hash::check($this->password, $this->user->password)) {
            $this->addError('samepassword', 'Sua senha atual está incorreta.');
            return;
        }
        
        if (Hash::check($this->new_password, $this->user->password)) {
            $this->addError('otherpassword', 'A nova senha deve ser diferente da anterior.');
            return;
        }

        $this->user->update([
            'password' => $this->new_password,
        ]);

        $this->reset(['password', 'new_password', 'new_password_confirmation']);
        Toaster::success('Senha atualizada com sucesso!');
    }

    public function updatedTimezone()
    {
        $this->user->timezone = $this->timezone;
        $this->user->save();

        Toaster::success('Fuso horário atualizado com sucesso!');
    }

    public function delete(){
        $user = Auth::user();
        
        if ($user) {
            Auth::logout();
            $user->delete();
        }

        Toaster::success('Usuário excluído com sucesso!');
        return redirect()->to('/');
    }
}
