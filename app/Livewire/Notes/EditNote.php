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
        $this->validate([
            'title' => ['required', 'string' ,'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'date' => ['date', 'required']
        ]);

        $data = [];
        if ($this->title && $this->title !== $this->note->title){
            $data['title'] = $this->title;
        }
        if ($this->description && $this->description !== $this->note->description){
            $data['description'] = $this->description;
        }
        if ($this->date && $this->date !== $this->note->date){
            $data['date'] = $this->date;
        }
        if (empty($data)) {
            return redirect('/notes');
        }

        $this->note->update($data);

        session()->flash('sucesso','Editado com sucesso!');
        return $this->redirect('/notes', navigate: true);
    }
}
