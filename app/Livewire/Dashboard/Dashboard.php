<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Note;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        $now = Carbon::now();

        $totalNotes = Note::where('user_id', $user->id)->count();
        $notesThisWeek = Note::where('user_id', $user->id)
            ->whereBetween('created_at', [$now->startOfWeek()->format('Y-m-d H:i:s'), $now->endOfWeek()->format('Y-m-d H:i:s')])
            ->count();

        $favoriteNotes = Note::where('user_id', $user->id)->where('is_favorite', true)->count();
        $tagsData = $user->tags()->withCount('notes')->orderByDesc('notes_count')->take(5)->get();

        return view('livewire.dashboard.index', [
            'totalNotes' => $totalNotes,
            'notesThisWeek' => $notesThisWeek,
            'favoriteNotes' => $favoriteNotes,
            'tagsData' => $tagsData,
        ]);
    }
}