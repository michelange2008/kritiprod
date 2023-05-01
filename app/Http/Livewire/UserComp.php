<?php

namespace App\Http\Livewire;

use App\Models\User;

class UserComp extends ItemComp
{
    public function mount()
    {
        parent::mount();
        $this->initDatas('user');
    }
    
    public function getItems()
    {
        return User::where('name', 'LIKE', "%{$this->search}%")->orderBy('name')->get();
    }

    public function createItem()
    {
        User::create($this->state);
    }

    public function updateItem()
    {
        User::where('id', $this->state['id'])
            ->update(['name' => $this->state['name']]);
    }

    public function editItem($id)
    {
        $user = User::find($id);
        $this->state = [
            'id' => $user->id,
            'name' => $user->name,
        ];
    }

    public function deleteItem($id)
    {
        User::destroy($id);
    }
}
