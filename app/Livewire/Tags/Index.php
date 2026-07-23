<?php

namespace App\Livewire\Tags;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Masmerise\Toaster\Toaster;
use Livewire\Component;
use App\Models\Tag;

class Index extends Component
{
    public $name = '';
    public $color = '#3B82F6';
    public $editingId = null;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'color' => ['required', 'string', 'max:7', 'regex:/^#[a-fA-F0-9]{6}$/'],
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            $tag = Tag::find($this->editingId);
            if ($tag && $tag->user_id === Auth::id()) {
                $tag->update(['name' => $this->name, 'color' => $this->color]);
                Toaster::success('Tag atualizada com sucesso!');
            }
        } else {
            Tag::create([
                'user_id' => Auth::id(),
                'name' => $this->name,
                'color' => $this->color,
            ]);
            Toaster::success('Tag criada com sucesso!');
        }

        $this->reset(['name', 'color', 'editingId']);
        $this->color = '#3B82F6';
    }

    public function edit(int $id)
    {
        $tag = Tag::find($id);
        if ($tag && $tag->user_id === Auth::id()) {
            $this->editingId = $tag->id;
            $this->name = $tag->name;
            $this->color = $tag->color;
        }
    }

    public function delete(int $id)
    {
        $tag = Tag::find($id);
        if ($tag && $tag->user_id === Auth::id()) {
            $tag->delete();
            Toaster::success('Tag excluída com sucesso!');
        }
    }

    public function cancel()
    {
        $this->reset(['name', 'color', 'editingId']);
        $this->color = '#3B82F6';
    }

    public function render()
    {
        return view('livewire.tags.index', [
            'tags' => Auth::user()->tags()->orderBy('name')->get()
        ]);
    }
}
