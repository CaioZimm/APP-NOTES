<?php

namespace App\Livewire\Notes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Masmerise\Toaster\Toaster;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Note;

class Trash extends Component
{
    use WithPagination;

    public function restore(int $id)
    {
        $note = Note::onlyTrashed()->find($id);

        if ($note) {
            Gate::authorize('update', $note);
            $note->restore();
            Toaster::success('Anotação restaurada com sucesso!');
        }
    }

    public function forceDelete(int $id)
    {
        $note = Note::onlyTrashed()->find($id);

        if ($note) {
            Gate::authorize('delete', $note);
            $note->forceDelete();
            Toaster::success('Anotação excluída permanentemente!');
        }
    }

    public function render()
    {
        $notes = Note::onlyTrashed()
            ->where('user_id', Auth::id())
            ->orderBy('deleted_at', 'desc')
            ->paginate(12);

        return view('livewire.notes.trash', [
            'notes' => $notes,
        ]);
    }
}
