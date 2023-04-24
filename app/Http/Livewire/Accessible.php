<?php

namespace App\Http\Livewire;

use App\Models\Accessible as ModelsAccessible;
use Livewire\Component;

class Accessible extends Component
{
    public $accessibles;

    public function mount()
    {
        $this->accessibles = ModelsAccessible::all();

    }
    public function render()
    {
        return view('livewire.accessible');
    }
}
