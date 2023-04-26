<?php

namespace App\Http\Livewire;

use App\Models\Accessible;
use Livewire\Component;

class AccessibleComp extends Component
{
    public $accessible;
    public $accessibles;
    public $showModal = false;

    protected $rules = [
        'accessible.nom' => 'required|string|max:191|min:2',
    ];

    protected $listeners = [
        'created',
        'updated',
    ];

    public function mount()
    {
        $this->accessibles = Accessible::all();
        $this->accessible = new Accessible();
    }

    public function created()
    {
        $this->showModal = false;
    }

    public function create()
    {
        $this->validate();
        $this->accessible->save();
        $this->showModal = false;
        // session()->flash('message', 'Un nouvel item a été créé.');
    }

    public function update()
    {
        $this->validate();
        $this->accessible->save();
        session()->flash('message', 'La mise à jour a été effectuée');
        $this->showModal = false;

    }

    public function delete($id)
    {
        Accessible::destroy($id);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.accessible-comp');
    }
}
