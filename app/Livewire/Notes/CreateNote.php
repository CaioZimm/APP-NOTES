<?php

namespace App\Livewire\Notes;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toaster;
use Livewire\Component;
use App\Models\Note;

class CreateNote extends Component
{
    public $title = '';
    public $description = '';
    public $date;
    public $selectedTags = [];

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
    }

    public function save()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:50000'],
            'date' => ['date', 'required']
        ]);

        $note = Note::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
        ]);

        if (!empty($this->selectedTags)) {
            $note->tags()->sync($this->selectedTags);
        }

        Toaster::success('Anotação criada com sucesso!');
        return Redirect::to('/notes');
    }

    public function render()
    {
        $userTags = Auth::user()->tags()->orderBy('name')->get();

        return view('livewire.notes.create-note', [
            'availableTags' => $userTags
        ]);
    }
}
