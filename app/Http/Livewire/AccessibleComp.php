<?php

namespace App\Http\Livewire;

use App\Models\Accessible;

class AccessibleComp extends ItemComp
{
    public function mount()
    {
        parent::mount();
        $this->initDatas('accessible');
    }
    
    public function getItems()
    {
        return Accessible::where('nom', 'LIKE', "%{$this->search}%")->get();
    }

    public function showItem($id)
    {
        $this->item =Accessible::find($id);
    }

    public function createItem()
    {
        Accessible::create($this->state);
    }

    public function updateItem()
    {
        Accessible::where('id', $this->state['id'])
            ->update(['nom' => $this->state['nom']]);
    }

    public function editItem($id)
    {
        $accessible = Accessible::find($id);
        $this->state = [
            'id' => $accessible->id,
            'nom' => $accessible->nom,
        ];
    }

    public function deleteItem($id)
    {
        Accessible::destroy($id);
    }
}
