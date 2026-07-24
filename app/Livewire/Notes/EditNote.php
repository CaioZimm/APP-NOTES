<?php

namespace App\Livewire\Notes;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toaster;
use Livewire\Component;
use App\Models\Note;

class EditNote extends Component
{
    public $note;
    public $title;
    public $description;
    public $date;
    public $selectedTags = [];

    public function mount(Note $note)
    {
        Gate::authorize('update', $note);

        $this->note = $note;
        $this->title = $note->title;
        $this->description = $note->description;
        $this->date = $note->date;
        $this->selectedTags = $note->tags()->pluck('tags.id')->toArray();
    }

    public function update()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:50000'],
            'date' => ['date', 'required']
        ]);

        $this->note->update([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
        ]);

        $validTagIds = Auth::user()->tags()->pluck('id')->toArray();
        $safeTagIds = array_values(array_intersect(array_map('intval', $this->selectedTags ?? []), $validTagIds));
        $this->note->tags()->sync($safeTagIds);

        Toaster::success('Anotação atualizada com sucesso!');
        return Redirect::to('/notes');
    }

    public function render()
    {
        $userTags = Auth::user()->tags()->orderBy('name')->get();

        return view('livewire.notes.edit-note', [
            'availableTags' => $userTags
        ]);
    }
}
