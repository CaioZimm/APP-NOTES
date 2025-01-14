<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ProfileUser extends Component
{
    public $user;

    public $name, $email;

    public $password, $new_password, $new_password_confirmation;

    public $timezone;

    public function mount(){
        $this->user = Auth::user();
        $this->timezone = $this->user->timezone;
    }

    public function render()
    {
        return view('livewire.profile.profile-user');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->redirect('/', navigate:true);
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

        Toaster::success('Informações atualizadas com sucesso!');
        return redirect()->to('/profile');
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
            'password' => bcrypt($this->new_password),
        ]);

        session()->flash('successPassword', 'Senha atualizada com sucesso!');
        return $this->redirect('/profile', navigate: true);
    }

    public function updatedTimezone()
    {
        $this->user->timezone = $this->timezone;
        $this->user->save();

        Toaster::success('Fuso horário atualizado com sucesso!');
        return redirect()->to('/profile');
    }

    public function delete(User $user){
        $user->delete();

        Toaster::success('Usuário excluído com sucesso!');
        return redirect()->to('/');
    }
}
