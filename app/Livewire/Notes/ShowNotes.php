<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowNotes extends Component
{
    public $notes = [];

    public function mount(){
        $this->notes = Note::all()->where('user_id', Auth::user()->id);
    }

    public function render()
    {
        return view('livewire.notes.show-notes');
    }

    public function deleteNote(Note $note){
        $note->delete();

        session()->flash('sucesso','Excluído com sucesso!');
        return $this->redirect('/notes', navigate: true);
    }
}
