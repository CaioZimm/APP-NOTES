<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;

class EditNote extends Component
{
    public $note, $title, $description, $date;

    public function mount(Note $note){
        $this->note = $note;
        
        $this->title = $note->title;
        $this->description = $note->description;
        $this->date = $note->date;
    }

    public function render()
    {
        return view('livewire.notes.edit-note');
    }

    public function update(){
        $validated=$this->validate([
            'title' => ['required', 'string' ,'max:255'],
            'description' => ['string', 'max:255'],
            'date' => ['date', 'required']
        ]);

        $this->note->update($validated);

        session()->flash('sucesso','Editado com sucesso!');
        return $this->redirect('/notes', navigate: true);
    }
}
