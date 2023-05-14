<?php

namespace App\Http\Livewire;

use App\Models\Application;

class ApplicationComp extends ItemComp
{
    public function mount($item = '')
    {
        parent::mount();
        $this->initDatas('application');
    }
    
    public function getItems()
    {
        return Application::where('nom', 'LIKE', "%{$this->search}%")->orderBy('nom')->get();
    }

    public function showItem($id)
    {
        # code...
    }

    public function createItem()
    {
        Application::create($this->state);
    }

    public function updateItem()
    {
        Application::where('id', $this->state['id'])
            ->update(['nom' => $this->state['nom']]);
    }

    public function editItem($id)
    {
        $application = Application::find($id);
        $this->state = [
            'id' => $application->id,
            'nom' => $application->nom,
        ];
    }

    public function deleteItem($id)
    {
        Application::destroy($id);
    }
}
