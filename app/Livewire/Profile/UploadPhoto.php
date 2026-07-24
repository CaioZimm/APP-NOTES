<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toaster;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Component;

class UploadPhoto extends Component
{
    use WithFileUploads;
    public $user, $photo;
    public bool $dropdownOpen = false;

    public function dropdown()
    {
        $this->dropdownOpen = !$this->dropdownOpen;
    }

    public function mount(){
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.profile.upload-photo');
    }

    public function uploadPhoto(){
        $this->validate([
            'photo' => ['required', 'image', 'max:10240']
        ]);

        $user = auth()->user();

        if ($user->photo && Storage::exists($user->photo)){
            Storage::delete($user->photo);
        }

        $nameFile = Str::slug($user->name) . '-' . time() . '.' . $this->photo->getClientOriginalExtension();

        if($path = $this->photo->storeAs('images', $nameFile)){
            $user->update([
                'photo' => $path
            ]);
            $this->user = $user;
        }

        $this->dropdownOpen = false;
        $this->photo = null;

        Toaster::success('Foto de perfil atualizada com sucesso!');
    }

    public function removePhoto(){
        if($this->user->photo){
            Storage::delete($this->user->photo);

            $this->user->photo = null;
            $this->user->save();
        }

        $this->dropdownOpen = false;

        Toaster::success('Foto de perfil removida com sucesso!');
    }
}