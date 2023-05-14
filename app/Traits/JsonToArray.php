<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Traits\LitJson;
use Illuminate\Database\Eloquent\Collection;

/**
 * Destiné à transformer un objet issu de la lecture d'un fichier json
 * en tableau utilisable par le livewire component ItemComp pour l'affichage
 * des models quelqu'ils soient
 */
trait JsonToArray
{

    use LitJson;

    /**
     * Undocumented function
     *
     * @param JSON $json: fichier json dont on ne donne que le nom sans l'extension
     * @return collection $values: collection avec toutes les informations:
     *              titre: titre de la page
     *              icone: icone associée au titre
     *              rules: règles d'enregistrement des champs du model correspondant
     *              titres: titre des colonnes du tableau
     *              champs: lignes du tableau avec tous les champs du model
     */
    public function jsonToArray($json)
    {
        $values = new Collection();
        $datas = (object) $this->litJson($json);
        
        $values->titre = $datas->titre ?? "Liste des items";
        $values->icone = $datas->icone ?? "default.svg";
        $values->sort = $datas->sort ?? 'id';
        $values->show = $datas->show ?? true;
        $values->add = $datas->add ?? true;
        // Il faut convertir les objets issus du json en array
        $fields = (array) $datas->champs;
        foreach ($fields as $key => $field) {
            $rules[$key] = $field->rules;
            $titres[$key] = [
                'label' => $field->label ?? "intitulé",
                'onTable' => $field->onTable ?? true,
            ];
            $champs[$key] = [
                'type' => $field->type ?? 'text',
                'field' => $field->field ?? '',
                'label' => $field->label ?? '',
                'align' => $field->align ?? 'left',
                'onTable' => $field->onTable ?? true,
                'options' => [],
            ];
            if ($field->type == "select") {
                $champs[$key]['belongsTo'] = $field->belongsTo ?? '';
                $champs[$key]['coltable'] = $field->coltable ?? '';
                $options = DB::table($field->table)->get();
                foreach ($options as $option) {
                    $champs[$key]['options'][$option->id] = $option->{$field->coltable};
                }
            }
        }

        $values->rules = $rules;
        $values->titres = $titres;
        $values->champs = $champs;

        return $values;
    }
}
