<?php

namespace App\Http\Livewire;

use App\Models\Application;
use App\Traits\LitJson;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ApplicationComp extends Component
{
    use LitJson;

    public $applications;
    public $state = [];
    public $titres = [];
    public $change = false;
    public $updateMode = false;

    protected $rules = [
        'nom' => 'required|string|max:191|min:2'
    ];

    public function mount()
    {
        $this->applications = Application::all();
        $this->titres = (array) $this->litJson('applications');
    }

    public function store()
    {

        Validator::make($this->state, $this->rules)->validate();

        Application::create($this->state);

        $this->reset('state');
        $this->change = false;
        $this->applications = Application::all();
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $application = Application::find($id);
        $this->state = [
            'id' => $application->id,
            'nom' => $application->nom,
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

        Application::where('id', $this->state['id'])
            ->update(['nom' => $this->state['nom']]);

        $this->cancel();
        $this->change = false;

        $this->applications = Application::all();
    }

    public function delete($id)
    {
        
        Application::destroy($id);
        $this->applications = Application::all();
    }

    public function render()
    {
        return view('livewire.application-comp');
    }
}
