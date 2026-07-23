<?php

namespace App\Livewire\Modal;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toaster;
use Livewire\Component;
use App\Models\Note;

class CreateNotes extends Component
{
    public $title, $description = '', $date;

    public function render()
    {
        return view('livewire.modal.create-notes');
    }

    public function create(){
        $this->validate([
            'title' => ['required', 'string'],
            'description' => ['string', 'max:500'],
            'date' => ['required', 'date']
        ]);

        Note::create([
            'user_id' => Auth::user()->id,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
        ]);
        
        Toaster::success('Anotação criada com sucesso!');
        return Redirect::to('/');
    }
}