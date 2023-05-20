<?php

namespace App\Http\Livewire;

use App\Models\Contenu;
use App\Models\Localisation;
use App\Models\Periode;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class RechercheComp extends Component
{
    public $localisations;
    public $periodes;
    public $contenus;
    public $records;
    public $model;
    public $table;
    public $columns;
    
    public $state = [];

    public function mount()
    {
        
        $this->localisations = Localisation::all();
        $this->periodes = Periode::all();
        
    }
    
    public function modele($model)
    {
        $this->model = $model;
        $this->table = strtolower($this->model).'s';
        $this->columns = Schema::getColumnListing($this->table);
        $modelWithPath = 'App\Models'.'\\'.$this->model;
        $this->records = $modelWithPath::all();

    }
    public function render()
    {
        return view('livewire.recherche-comp');
    }

    public function select()
    {
        return $this->state;
        // $this->contenus = Contenu::whereLocalisationId($this->state['localisation'])
        //                     ->wherePeriodeId($this->state['periode'])->get();

        // return $this->contenus;
    }
}
