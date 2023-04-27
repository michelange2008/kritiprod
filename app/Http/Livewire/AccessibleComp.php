<?php

namespace App\Http\Livewire;

use App\Models\Accessible;
use Livewire\Component;

class AccessibleComp extends Component
{
    public $accessible;
    public $nom;
    public $accessibles;
    public $showModal;

    protected $rules = [
        'accessible.nom' => 'required|string|max:191|min:2',
    ];

    protected $listeners = [
        'created' => 'itemCreated',
    ];

    public function mount()
    {
        $this->accessibles = Accessible::all();
        $this->accessible = new Accessible();
        $this->showModal = false;

    }

    public function itemCreated()
    {
        
        $this->showModal = false;
        $this->mount();
        session()->flash('message', 'Un nouvel item a été créé.');
    }

    public function create()
    {
        $this->validate();
        $this->accessible->save();
        $this->emit('created');

    }

    public function update($id)
    {
   
        $this->validate([
            'nom' => 'required|string|max:191|min:4'
        ]);
        $accessible = Accessible::find($id);
        $accessible->nom = $this->nom;
        $accessible->save();
        // $this->emit('created');
        session()->flash('message', 'La mise à jour a été effectuée');
        $this->mount();

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
