<?php

namespace App\Http\Livewire;

use App\Traits\JsonToArray;
use App\Traits\LitJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

abstract class ItemComp extends Component
{
    use LitJson, JsonToArray;

    public $items;
    public $item;
    public $table;
    public $model;
    public $modelWithPath;
    public array $state = [];
    public array $titres = [];
    public array $champs = [];
    public string $titre;
    public string $icone;
    public string $sort;
    public string $show;
    public string $add;
    public bool $change = false;
    public bool $updateMode = false;
    public bool $toShow = false;
    public string $search = '';

    protected array $rules = [];

    public function mount($model)
    {
        $this->items = $this->getItems();
    }

    public function updated()
    {
        $this->items = $this->getItems();
    }

    public function initDatas($json)
    {
        // Utilisation du trait JsonToArray pour récupérer les données du model 
        $datas = $this->jsonToArray($json);
        $this->titre = $datas->titre;
        $this->icone = $datas->icone;
        $this->sort = $datas->sort;
        $this->show = $datas->show;
        $this->add = $datas->add;
        $this->rules = $datas->rules;
        $this->titres = $datas->titres;
        $this->champs = $datas->champs;
    }

    public function show($id)
    {
        $this->showItem($id);
    }

    public function store()
    {
        Validator::make($this->state, $this->rules)->validate();

        $this->createItem();

        $this->reset('state');
        $this->change = false;
        $this->items = $this->getItems();
    }


    public function edit($id)
    {
        $this->updateMode = true;

        $this->editItem($id);
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

        $this->updateItem();
        $this->cancel();
        $this->change = false;

        $this->items = $this->getItems();
    }

    public function delete($id)
    {
        $this->deleteItem($id);
        $this->items = $this->getItems();
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->items = $this->getItems();
    }

    /**
     * Cherche dans la bdd l'ensemble des valeurs pour un item donné
     * $this->items = Class::orderBy('nom')->get();
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    abstract public function getItems();

    /**
     * Affiche le contenu d'un item
     *
     * @param int $id
     * @return void
     */
    abstract public function showItem($id);

    /**
     * Crée un item sur la base des informations présentes dans state
     * Class::create($this->state);
     *
     * @return void
     */
    abstract public function createItem();

    /**
     * Met à jour le contenu d'un item sur la base des informations présentes dans state
     * Localisation::where('id', $this->state['id'])->update(['nom' => $this->state['nom']]);
     *
     * @return void
     */
    abstract public function updateItem();

    /**
     * Recherche l'item à modifier et peuple la variable state avec les informations
     * $class = Class::find($id);
     * $this->state = [
     *       'id' => $class->id,
     *       'nom' => $class->nom,
     *       ...
     * ];
     *
     * @param int $id id de l'item qui doit être modifié
     * @return void
     */
    abstract public function editItem($id);

    /**
     * Détruit un item
     * Class::destroy($id);
     * 
     * @param int $id
     * @return void
     */
    abstract public function deleteItem($id);

    public function render()
    {
        return view('livewire.item-comp');
    }
}
