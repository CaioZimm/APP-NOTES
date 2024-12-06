<?php

namespace App\Livewire\Modal;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

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

        $message = "Anotação criada com sucesso!";
        return Redirect::to('/')->with('message', $message);
    }
}