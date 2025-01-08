<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toaster;

class UploadPhoto extends Component
{
    use WithFileUploads;
    public $photo;
    public $user;

    public function mount(){
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.profile.upload-photo');
    }

    public function uploadPhoto(){
        $this->validate([
            'photo' => ['required', 'image', 'max:1024']
        ]);

        $user = auth()->user();

        $nameFile = Str::slug($user->name) . '.' . $this->photo->getClientOriginalExtension();

        if($path = $this->photo->storeAs('images', $nameFile)){
            $user->update([
                'photo' => $path
            ]);
        }

        Toaster::success('Foto de perfil atualizada com sucesso!');
        return redirect()->to('/profile');
    }

    public function removePhoto(){
        if($this->user->photo){
            Storage::delete($this->user->photo);

            $this->user->photo = null;
            $this->user->save();
        }

        Toaster::success('Foto de perfil removida com sucesso!');
        return redirect()->to('/profile');
    }
}