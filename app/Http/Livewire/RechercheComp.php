<?php

namespace App\Http\Livewire;

use App\Models\Contenu;
use App\Models\Periode;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class RechercheComp extends Component
{
    public $records; // Liste des enregistrements issus de la table choisie
    public $recordsBack;
    public $modelInfosFromJson; // Informations sur le model issu du json correspondant
    public $model = 'Contenu'; // Nom du model (correspondant au fichier dans le rep App\Models)
    public $modelWithPath; // Nom du model avec le chemin d'accès
    public $table; // Nom de la table dans la bdd pour le model 
    public $columns; // Liste des intitulés de colonnes (récupérées à partir du json et non de la table)
    public $selectedColumns = []; // Liste des colonnes retenues pour affichage
    public $linkedModels = []; // Liste des models auxquels le model principal fait référence (relation one to many)
    public $toggleList = []; // Liste des linkedModels avec un booléen pour savoir si on affiche ou non le contenu de ces linkedModels
    public $choices = []; // Liste pour chaque linkedModel des items retenus pour l'affichage de la recherche
    public $search = "";

    public function mount()
    {
        $this->selectModel('Contenu');
    }

    public function updated()
    {
        $this->updateRecords();
    }

    /**
     * Permet de choisir la table dont on veut afficher le enregistrements
     * 
     * Cette méthode définit les infos de base: nom du model, de la table, liste des colonnes
     * et initailise les infos d'affichages: colonnes à afficher, models liés, ...
     * 
     * @param: String nom du model
     */
    public function selectModel(String $model)
    {
        $this->model = $model;
        $this->modelWithPath = 'App\Models' . '\\' . $this->model;
        $this->table = strtolower($this->model) . 's';
        $this->setDatas();

        $this->records = $this->modelWithPath::all();
        $this->recordsBack = clone $this->records;
    }
    /**
     * Produit les données d'un model choisi après avoir récupérer les infos depuis un json
     * peuple les varaibles: liste des colonnes, colones choisies, models liés (OneToMany) et 
     * mise à false de l'affichage de ces models liés.
     */
    public function setDatas()
    {
        $this->modelInfosFromJson = Storage::json(strtolower('public/json/' . $this->model . '.json'));
        $this->columns = [];
        $this->linkedModels = [];
        $this->columns = $this->modelInfosFromJson['champs'];
        foreach ($this->columns as $field => $infos) {
            $this->columns[$field]['visible'] = true;
            if ($infos['type'] == 'select') {
                $linkedModel = ucfirst($infos['belongsTo']);
                $this->toggleList[$linkedModel] = false;
                $linkedModelWithPath = 'App\Models' . '\\' . $linkedModel;
                $linkedModelDatas = $linkedModelWithPath::all();
                $this->choices[$linkedModel] = [];
                foreach ($linkedModelDatas as $data) {
                    $this->choices[$linkedModel][$data->id] = true;
                    $this->choices[$linkedModel]['all'] = true;
                }
                $this->linkedModels[] = [
                    'label' => $infos['label'],
                    'model' => ucfirst($infos['belongsTo']),
                    'coltable' => $infos['coltable'],
                    'datas' => $linkedModelDatas,
                ];
            }
        }
        $this->selectedColumns = $this->columns;
        $this->selectedColumns['id']['visible'] = false;
    }

    /**
     * Permet de choisir les champs affichés dans le résultat des recherches
     * 
     * @param String champs de la table que l'on veut ou non afficher
     */
    public function selectColumns(String $field)
    {
        ($this->selectedColumns[$field]['visible'])
            ? $this->selectedColumns[$field]['visible'] = false
            : $this->selectedColumns[$field]['visible'] = true;
    }

    /**
     * Permet d'ajouter ou d'enlever un item d'un model lié 
     * (par exemple ajouter ou supprimer une localisation dans le model lié Localisation)
     * 
     * @param String $linkedModel: model lié concerné
     * @param String $id: id de l'enregistriment dans le model lié
     */
    public function toggleValue(String $linkedModel, Int $id)
    {
        $this->choices[$linkedModel][$id] = ($this->choices[$linkedModel][$id]) ? false : true;

        $this->displayChoosenRecords();
    }

    /**
     * Permet de basculer l'affichage des item d'un model lié entre tout ou rien
     * 
     * @param String $linkedModel nom du model lié
     * @param Bool $all vrai si on choisit tout ou faux si on ne choisit rien
     */
    public function allValues(String $linkedModel, Bool $all)
    {
        foreach ($this->choices[$linkedModel] as $id => $checked) {

            $this->choices[$linkedModel][$id] = $all;

        }

        $this->displayChoosenRecords();
    }

    /**
     * affiche les enregistrements correspondant aux choix effectuer en reprenant
     * la liste initiale des enregistrements et éliminant ceux dont l'id n'est pas
     * présente dans le fichier choices.
     */
    public function displayChoosenRecords()
    {
        $this->records = clone $this->recordsBack;
        
        foreach ($this->records as $id_record => $record) {

            foreach ($this->choices as $model => $listIdVisibles) {

                foreach ($listIdVisibles as $id => $visible) {
                    
                    if ($record->{strtolower($model)}->id == $id  && !$visible) {

                        $this->records->forget($id_record);
                    }
                }
            }
        }
    }

    public function updateRecords()
    {
        $query = $this->modelWithPath::query();
        foreach (Schema::getColumnListing($this->table) as $column) {
            $query->orWhere($column, 'LIKE', '%' . $this->search . '%');
        }
        $this->records = $query->get();
        $this->recordsBack = clone $this->records;
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->updateRecords();
    }

    public function render()
    {
        return view('livewire.recherche-comp');
    }
}
