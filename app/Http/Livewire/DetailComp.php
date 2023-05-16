<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Schema;

class DetailComp extends ItemComp
{
    public $model;
    public $modelWithPath;
    public $table;
    public $columns;

    public function mount($model)
    {
        $this->model = $model;
        $this->table = $model.'s';
        $this->modelWithPath = 'App\Models'.'\\'.ucfirst($model);
        $this->columns = Schema::getColumnListing($this->table);
        parent::mount($model);
        $this->initDatas($model);
    }

    public function getItems()
    {
        $cols = $this->columns;
        // Permet de faire une recherche sur tous les champs texte
        $liste = $this->modelWithPath::where(function ($query) use ($cols) {
            foreach ($cols as $field)
                $query->orWhere($field, 'like', '%' . $this->search . '%');
        })->get();
 
        return $liste;
    }

    public function showItem($id)
    {
        $this->item = $this->modelWithPath::find($id);
    }

    public function createItem()
    {
        $this->modelWithPath::create($this->state);
    }

    public function updateItem()
    {
        $this->modelWithPath::where('id', $this->state['id'])
            ->update(['nom' => $this->state['nom']]);
    }

    public function editItem($id)
    {
        $record = $this->modelWithPath::find($id);
        $etat = [];
        foreach ($this->columns as $col ) {
            $etat[$col] = $record->{$col};
        }

        $this->state = $etat;
    }

    public function deleteItem($id)
    {
        $this->modelWithPath::destroy($id);
    }
}
