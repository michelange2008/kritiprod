<?php

namespace App\Http\Livewire;

use App\Models\Periode;

class PeriodeComp extends ItemComp
{
    public array $rules = [];

    public function mount()
    {
        parent::mount();
        $this->initDatas('periode'); // prend dans le json toutes les infos propres à cet item
    }

    public function getItems()
    {
        return Periode::where('nom', 'LIKE', "%{$this->search}%")->get();
    }

    public function showItem($id)
    {
        $this->item = Periode::find($id);
    }

    public function createItem()
    {
        Periode::create($this->state);
    }

    public function updateItem()
    {
        Periode::where('id', $this->state['id'])
            ->update(['nom' => $this->state['nom']]);
    }

    public function editItem($id)
    {
        $periode = Periode::find($id);
        $this->state = [
            'id' => $periode->id,
            'nom' => $periode->nom,
        ];
    }

    public function deleteItem($id)
    {
        Periode::destroy($id);
    }
}
