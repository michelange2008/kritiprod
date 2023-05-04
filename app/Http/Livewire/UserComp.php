<?php

namespace App\Http\Livewire;

use App\Models\User;

class UserComp extends ItemComp
{
    public $role_id = "";
    
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
            ->update(
                ['name' => $this->state['name']],
                ['role_id' => $this->state['role_id']],
            );
    }

    public function editItem($id)
    {
        $user = User::find($id);
        $this->state = [
            'id' => $user->id,
            'name' => $user->name,
            'role_id' => $user->role_id,
        ];
    }

    public function deleteItem($id)
    {
        User::destroy($id);
    }
}
