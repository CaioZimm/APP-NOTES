<?php

namespace App\Livewire\Notes;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Masmerise\Toaster\Toaster;
use Livewire\WithPagination;
use App\Traits\HasLogout;
use Livewire\Component;
use App\Models\Note;

class ShowNotes extends Component
{
    use WithPagination;
    use HasLogout;

    public string $search = '';
    public string $orderBy = '';
    public bool $favoritesOnly = false;
    public ?int $selectedTagId = null;

    protected $listeners = ['orderByUpdated'];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFavoritesOnly(): void
    {
        $this->resetPage();
    }
    
    public function selectTag(?int $tagId): void
    {
        $this->selectedTagId = $tagId;
        $this->resetPage();
    }

    public function orderByUpdated(string $value): void
    {
        $this->orderBy = $value;
        $this->resetPage();
    }

    public function toggleFavorite(int $id): void
    {
        $note = Note::find($id);
        if ($note) {
            Gate::authorize('update', $note);
            $note->update(['is_favorite' => !$note->is_favorite]);
        }
    }

    public function deleteNote(int $id): void
    {
        $note = Note::find($id);

        if ($note) {
            Gate::authorize('delete', $note);
            $note->delete();
            Toaster::success('Anotação excluída com sucesso!');
        }
    }

    public function render()
    {
        $query = Note::query()
            ->with('tags')
            ->where('user_id', Auth::id())
            ->when($this->search !== '', fn($q) => $q->search($this->search))
            ->favorites($this->favoritesOnly)
            ->byTag($this->selectedTagId)
            ->sort($this->orderBy);

        return view('livewire.notes.show-notes', [
            'notes' => $query->paginate(12),
            'userTags' => Auth::user()->tags
        ]);
    }
}
