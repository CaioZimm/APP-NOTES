<?php

namespace App\Livewire\Modal;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateNotes extends Component
{
    public $title = '';
    public $description = '';
    public $date = '';

    public function render()
    {
        return view('livewire.modal.create-notes');
    }

    public function create(){
        $this->validate([
            'title' => ['required', 'string'],
            'description' => ['string', 'max:555'],
            'date' => ['required', 'date']
        ]);

        Note::create([
            'user_id' => Auth::user()->id,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
        ]);

        return $this->redirect('/', navigate: true);
    }
}