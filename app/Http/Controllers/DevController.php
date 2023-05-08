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
        // dd($request->all());
        $model_json = (object) $this->litJson($model);

        $datas = [];
        $datas['titre'] = $request->titre ?? $model_json->titre;
        $datas['icone'] = $request->icone ?? $model_json->icone;
        $datas['sort'] = $request->sort ?? $model_json->sort;
        $datas['show'] = ($request->show == "on")? true : false;
        $datas['add'] = ($request->add == "on")? true : false;

        dd($datas);
    }
}
