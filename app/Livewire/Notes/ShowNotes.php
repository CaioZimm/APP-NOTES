<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowNotes extends Component
{
    public $orderBy = '';
    public $notes = [];
    protected $listeners = ['orderByUpdated'];
    
    public function mount(){
        $this->showNotes();
    }

    public function orderByUpdated($value){
        $this->orderBy = $value;
        $this->showNotes();
    }

    public function showNotes(){
        $query = Note::query()->where('user_id', Auth::user()->id);

        switch($this->orderBy) {
            case 'alphabetical':
                $query->orderBy('title', 'asc');
                break;
            case 'newest':
                $query->orderBy('date', 'desc');
                break;
            case 'oldest':
                $query->orderBy('date', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $this->notes = $query->get();
    }
    
    public function logout(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return $this->redirect('/', navigate:true);
    }
    public function render()
    {
        return view('livewire.notes.show-notes', ['notes' => $this->notes,]);
    }
}
