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

    protected $listeners = ['orderByUpdated'];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFavoritesOnly(): void
    {
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
        $query = Note::query()->with('tags')->where('user_id', Auth::id());

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->favoritesOnly) {
            $query->where('is_favorite', true);
        }

        switch ($this->orderBy) {
            case 'alphabetical':
                $query->orderBy('title', 'asc');
                break;
            case 'newest':
                $query->orderBy('date', 'desc');
                break;
            case 'oldest':
                $query->orderBy('date', 'asc');
                break;
            case 'favorites':
                $query->orderBy('is_favorite', 'desc')->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('is_favorite', 'desc')->orderBy('created_at', 'desc');
        }

        return view('livewire.notes.show-notes', [
            'notes' => $query->paginate(12),
        ]);
    }
}
