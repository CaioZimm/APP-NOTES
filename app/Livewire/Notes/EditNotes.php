<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;

class EditNotes extends Component
{
    public $note;
    public $title;
    public $description;
    public $date;
    public function mount(Note $note){
        $this->note = $note;

        $this->title = $note->title;
        $this->description = $note->description;
        $this->date = $note->date; 
    }

    public function render()
    {
        return view('livewire.notes.edit-notes');
    }
    public function update(){
        $validated = $this->validate([
            'title' => ['string', 'required'],
            'description' => ['string'],
            'date' => ['required', 'date'],
        ]);

        $this->note->update([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
        ]);

        return $this->redirect('/notes', navigate: true);
    }
}
