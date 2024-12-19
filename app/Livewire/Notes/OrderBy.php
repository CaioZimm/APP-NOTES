<?php

namespace App\Livewire\Notes;

use Livewire\Component;

class OrderBy extends Component
{
    public $orderBy = '';

    public function updatedOrderBy($value){
        $this->dispatch('orderByUpdated', $value);
    }

    public function render()
    {
        return view('livewire.notes.order-by');
    }
}
