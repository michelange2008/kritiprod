<?php

namespace App\Http\Controllers;

use App\Traits\LitJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class DevController extends Controller
{
    use LitJson;
    
    public function index()
    {
        $modeles = $this->litJson('modeles');

        foreach ($modeles as $modele) {

            $modele->hasJson = Storage::disk('local')->exists("public/json/".$modele->model.".json");
        }

        return view('dev.index-dev', [
            "modeles" => $modeles,
        ]);
    }

    public function show($model)
    {

        try {
            $parametres = $this->litJson($model);
            return view('dev.show-dev', [
                'model' => $model,
                'parametres' => $parametres,

            ]);
        } catch (\Throwable $th) {
            return view('dev.wip-dev');
        }

    }

    public function add($model)
    {
        $dataTable_columns = Schema::getColumnListing($model.'s');

        $template = (object) $this->litJson('template');

        
        foreach ($dataTable_columns as $column) {
            $template_champs = (object) $this->litJson('template_champs');
            $template_champs->field = $column;

            if(count(explode('_', $column)) == 2) {
                $template_champs->type = 'select';
                $template_champs->table = explode("_", $column)[0].'s';
                $template_champs->belongsTo = explode("_", $column)[0];
            }
            $template->champs->{$column} =$template_champs;
        }

        // Crée le fichier json
        Storage::disk('local')->put('public/json/'.$model.'.json', json_encode($template));
        // Renvoie la page de formulaire
        return view('dev.show-dev', [
            'model' => $model,
            'parametres' => $template,
        ]);

    }

    public function update(Request $request, $model)
    {
        $model_json = (object) $this->litJson($model);
        $datas['titre'] = $request->titre ?? $model_json->titre;
        if ( $request->icone != null && $request->icone->isValid()) {
            $icone_name = strtolower($model.".".$request->icone->extension());
            $datas['icone'] = $icone_name ?? $model_json->icone;
            $request->icone->storeAs('public/img/icones', $icone_name);
        } else {
            $datas['icone'] = $model_json->icone;
        }
        
        $datas['sort'] = $request->sort ?? $model_json->sort;
        $datas['show'] = ($request->show == "on")? true : false;
        $datas['add'] = ($request->add == "on")? true : false;
        
        foreach ($model_json->champs as $col => $champ)
        {
            $datas['champs'][$col]['type'] = $request->{$col."_type"};
            $datas['champs'][$col]['field'] = $model_json->champs->{$col}->field;
            $datas['champs'][$col]['label'] = $request->{$col."_label"};
            $datas['champs'][$col]['rules'] = $request->{$col."_rules"};
            $datas['champs'][$col]['align'] = $request->{$col."_align"};
            $datas['champs'][$col]['onTable'] = ($request->{$col."_onTable"} == "1") ? true : false;
            
            if ($request->{$col."_type"} == 'select') {
                $datas['champs'][$col]['table'] = $request->{$col."_table"};
                $datas['champs'][$col]['belongsTo'] = $request->{$col."_belongsTo"};
                $datas['champs'][$col]['coltable'] = $request->{$col."_coltable"};
            }
        }

        $new_json = json_encode($datas, JSON_UNESCAPED_UNICODE);
        // Stocke sous forme de json, les informations pour la table correspondante
        Storage::disk('local')->put("public/json/".$model.".json", $new_json);

        // Modifie le menu admin
        $nav_tables = Storage::disk('local')->json('public/json/nav_tables.json');
        $nav_tables['sousmenus'][$model]['url'] = $model;
        $nav_tables['sousmenus'][$model]['intitule'] = $datas['titre'];
        Storage::disk('local')->put('public/json/nav_tables.json', json_encode($nav_tables, JSON_UNESCAPED_UNICODE));

        return redirect()->route('dev.index');
    }
}
