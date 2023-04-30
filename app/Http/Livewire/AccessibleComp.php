<?php

namespace App\Http\Livewire;

use App\Models\Accessible;
use App\Traits\LitJson;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AccessibleComp extends Component
{
    use LitJson;

    public $accessibles;
    public array $state = [];
    public array $titres = [];
    public string $titre;
    public string $icone;
    public bool $change = false;
    public bool $updateMode = false;

    protected $rules = [
        'nom' => 'required|string|max:191|min:2'
    ];

    public function mount()
    {
        $this->accessibles = Accessible::all();
        $datas = (object) $this->litJson('accessibles');
        $this->titre = $datas->titre;
        $this->icone = $datas->icone;
        $this->titres = (array) $datas->titres;
    }

    public function store()
    {

        Validator::make($this->state, $this->rules)->validate();

        Accessible::create($this->state);

        $this->reset('state');
        $this->change = false;
        $this->accessibles = Accessible::all();
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $accessible = Accessible::find($id);
        $this->state = [
            'id' => $accessible->id,
            'nom' => $accessible->nom,
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

        Accessible::where('id', $this->state['id'])
            ->update(['nom' => $this->state['nom']]);

        $this->cancel();
        $this->change = false;

        $this->accessibles = Accessible::all();
    }

    public function delete($id)
    {
        
        Accessible::destroy($id);
        $this->accessibles = Accessible::all();
    }

    public function render()
    {
        return view('livewire.accessible-comp');
    }
}
