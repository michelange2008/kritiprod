<?php

namespace App\Http\Livewire;

use App\Models\Accessible;
use Livewire\Component;

class AccessibleComp extends Component
{
    public $accessible;
    public $accessibles;

    protected $rules = [
        'accessible.nom' => 'required|string|max:191',
    ];

    public function mount()
    {
        $this->accessibles = Accessible::all();
        $this->accessible = new Accessible();
    }

    public function create()
    {
        $this->validate();
        $this->accessible->save();
        $this->mount();
    }

    public function edit()
    {
        dd($this->accessible);
    }
    public function render()
    {
        return view('livewire.accessible-comp');
    }
}
