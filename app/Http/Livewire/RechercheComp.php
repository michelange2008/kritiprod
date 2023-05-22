<?php

namespace App\Http\Livewire;

use App\Models\Contenu;
// use App\Models\Localisation;
use App\Models\Periode;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class RechercheComp extends Component
{
    public $localisations;
    public $periodes;
    public $contenus;
    public $records;
    public $subject;
    public $model;
    public $modelWithPath;
    public $table;
    public $columns;
    public $selectedColumns = [];
    public $state = [];
    public $choices = [];

    public function mount()
    {

        $localisationWithPath = 'App\Models'.'\\'.'Localisation';
        $this->localisations = $localisationWithPath::all();
        $this->periodes = Periode::all();
    }

    public function modele($model)
    {
        $this->model = $model;
        $this->modelWithPath = 'App\Models' . '\\' . $this->model;
        $this->table = strtolower($this->model) . 's';
        $this->setDatas();

        $this->records = $this->modelWithPath::select(array_keys($this->selectedColumns))->get();

    }

    public function setDatas()
    {
        $this->subject = Storage::json(strtolower('public/json/' . $this->model . '.json'));
        $this->columns = [];
        $this->columns = $this->subject['champs'];
        foreach ($this->columns as $field => $infos) {
            $this->columns[$field]['visible'] = true;
        }
        $this->selectedColumns = $this->columns;
        $this->selectedColumns['id']['visible'] = false;
    }

    public function selectColumns($field)
    {
        ($this->selectedColumns[$field]['visible']) 
            ? $this->selectedColumns[$field]['visible'] = false 
            : $this->selectedColumns[$field]['visible'] = true;

        $this->records = $this->modelWithPath::select(array_keys($this->selectedColumns))->get();
    }

    public function addValue($model, $id)
    {
        if(array_key_exists($model, $this->choices) && in_array($id, $this->choices[$model])) {

            $key = array_keys($this->choices[$model], $id);
            dd($key);
            unset($this->choices[$model][$key]);

        } else {

            $this->choices[$model][] = $id;
        }
        $this->result();
    }

    public function toggleValues($model, $allnone)
    {
        $values = ('App\Models' . '\\' . $model)::all();
        if ($allnone == 'all') {
            foreach ($values as $value ) {
                $this->choices[$model][] = $value['id'];
            }
        } else {
            $this->choices[$model] = [];
        }
        $this->result();

    }

    public function result()
    {
        $this->records = $this->modelWithPath::select(array_keys($this->selectedColumns))
        ->whereIn('localisation_id', $this->choices['Localisation'])
        ->get();

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
