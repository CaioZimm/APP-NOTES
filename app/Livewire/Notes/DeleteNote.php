<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
use Masmerise\Toaster\Toaster;

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

            Toaster::success('Anotação excluída com sucesso!');
            return Redirect::to('/notes');
        }
    }

    public function render()
    {
        return view('livewire.notes.delete-note');
    }
}
