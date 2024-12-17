<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;

class DeleteNote extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function deleteNote(){
        $note = Note::find($this->id);

        if ($note){
            $note->delete();

            session()->flash('sucesso', 'Anotação excluída!');
            return $this->redirect('/notes');
        }
    }

    public function render()
    {
        return view('livewire.notes.delete-note');
    }
}
