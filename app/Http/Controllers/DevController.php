<?php

namespace App\Http\Controllers;

use App\Traits\LitJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $inputs = [
            "text" => "Texte",
            "hidden" => "Champ caché",
            "email" => "Adresse électronique",
            "number" => "Nombre",
            "date" => "Date",
            "tel" => "Numéro de téléphone",
            "file" => "Fichier",
            "select" => "Liste déroulante",
        ];

        try {
            $parametres = $this->litJson($model);
            return view('dev.show-dev', [
                'model' => $model,
                'parametres' => $parametres,
                'inputs' => $inputs, 
            ]);
        } catch (\Throwable $th) {
            return view('dev.wip-dev');
        }

    }

    public function add($model)
    {
        // fopen('storage/json/essai.json', 'c+');
    }

    public function update(Request $request, $model)
    {
        $model_json = (object) $this->litJson($model);
        $datas['titre'] = $request->titre ?? $model_json->titre;
        if ( $request->icone != null && $request->icone->isValid()) {
            $icone_name = strtolower($datas['titre']).".".$request->icone->extension();
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
            $datas['champs'][$col]['field'] = $request->{$col."_field"};
            $datas['champs'][$col]['label'] = $request->{$col."_label"};
            $datas['champs'][$col]['rules'] = $request->{$col."_rules"};
            $datas['champs'][$col]['align'] = $request->{$col."_align"};
            $datas['champs'][$col]['onTable'] = $request->{$col."_onTable"};

            if ($request->{$col."_type"} == 'select') {
                $datas['champs'][$col]['table'] = $request->{$col."_table"};
                $datas['champs'][$col]['belongsTo'] = $request->{$col."_belongsTo"};
                $datas['champs'][$col]['coltable'] = $request->{$col."_coltable"};
            }
        }
        $new_json = json_encode($datas, JSON_UNESCAPED_UNICODE);

        Storage::disk('local')->put("public/json/".$model.".json", $new_json);
        return redirect()->route('dev.index');
    }
}
