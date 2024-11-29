<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileUser extends Component
{
    public $user;

    public $name;
    public $email;

    public function mount(){
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.profile.profile-user');
    }

    public function update(){
        $validated = $this->validate([
            'name' => ['max: 255'],
            'email' => ['email', 'string', 'unique:users']
        ]);

        $this->user->update($validated);

        return $this->redirect('/profile', navigate: true);
    }

    public function updatePassword(){

    }

    public function delete(User $user){
        $user->delete();
        session()->flash('sucesso', 'Usuário excluído com sucesso!');

        return $this->redirect('/', navigate:true);
    }
}
