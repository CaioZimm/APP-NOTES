<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowNotes extends Component
{
    public $notes = [];

    public function mount(){
        $this->notes = Note::all()->where('user_id', Auth::user()->id);
    }

    public function deleteNote(Note $note){
        $note->delete();

        session()->flash('sucesso','Excluído com sucesso!');
        return $this->redirect('/notes', navigate: true);
    }
    public function logout(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return $this->redirect('/', navigate:true);
    }
    public function render()
    {
        return view('livewire.notes.show-notes');
    }
}
