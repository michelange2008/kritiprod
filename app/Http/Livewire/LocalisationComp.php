<?php

namespace App\Http\Livewire;

use App\Models\Localisation;
use App\Traits\LitJson;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class LocalisationComp extends Component
{
    use LitJson;

    public $localisations;
    public $state = [];
    public $titres = [];
    public $change = false;
    public $updateMode = false;

    protected $rules = [
        'nom' => 'required|string|max:191|min:2'
    ];

    public function mount()
    {
        $this->localisations = Localisation::orderBy('nom')->get();
        $this->titres = (array) $this->litJson('localisations');
    }

    public function store()
    {

        Validator::make($this->state, $this->rules)->validate();

        Localisation::create($this->state);

        $this->reset('state');
        $this->change = false;
        $this->localisations = Localisation::sortBy('nom')->get();
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $localisation = Localisation::find($id);
        $this->state = [
            'id' => $localisation->id,
            'nom' => $localisation->nom,
        ];
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset('state');
    }

    public function addModal()
    {
        $this->cancel();
        $this->change = $this->change ? false : true;
    }

    public function update()
    {
        Validator::make($this->state, $this->rules)->validate();

        Localisation::where('id', $this->state['id'])
            ->update(['nom' => $this->state['nom']]);

        $this->cancel();
        $this->change = false;

        $this->localisations = Localisation::all();
    }

    public function delete($id)
    {
        
        Localisation::destroy($id);
        $this->localisations = Localisation::all();
    }

    public function render()
    {
        return view('livewire.localisation-comp');
    }
}
