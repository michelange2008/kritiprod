<?php

namespace App\Http\Livewire;

use App\Models\Accessible as ModelsAccessible;
use Livewire\Component;

class Accessible extends Component
{
    protected Accessible $accessible;
    public $accessibles;

    protected $validate = [
        'accessible.nom' => 'required|string|max:191',
    ];

    public function mount()
    {
        $this->accessibles = ModelsAccessible::all();
        $this->accessible = new Accessible();
    }

    public function create()
    {
        $this->validate();
        dd($this->accessible);
    }
    public function render()
    {
        return view('livewire.accessible');
    }
}
