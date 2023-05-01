<?php

namespace App\Http\Livewire;

use App\Models\Localisation;

class LocalisationComp extends ItemComp
{


    public function mount()
    {
        parent::mount();
        $this->initDatas('localisation'); // prend dans le json toutes les infos propres à cet item
    }

    public function getItems()
    {
        return Localisation::where('nom', 'LIKE', "%{$this->search}%")->orderBy('nom')->get();
    }

    public function createItem()
    {
        Localisation::create($this->state);
    }

    public function updateItem()
    {
        Localisation::where('id', $this->state['id'])
            ->update(['nom' => $this->state['nom']]);
    }

    public function editItem($id)
    {
        $localisation = Localisation::find($id);
        $this->state = [
            'id' => $localisation->id,
            'nom' => $localisation->nom,
        ];
    }

    public function deleteItem($id)
    {
        Localisation::destroy($id);
    }
}
