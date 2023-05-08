<x-app-layout>

    <x-titres.titre :icone="$parametres->icone">Paramétrage de {{ $parametres->titre }} </x-titres.titre>

    <div class="p-3">
        <form action="{{ route('dev.update', $model)}}" method="POST">
            @csrf
            <div class="flex flex-col gap-3">
                <div>
                    <input id="show" class="rounded text-teal-800" name="show" type="checkbox"
                        checked="{{ $parametres->show }}">
                    <label for="show">Pouvoir afficher les détails</label>
                </div>
                <div>
                    <input id="add" class="rounded text-teal-800" name="add" type="checkbox"
                        checked="{{ $parametres->add }}">
                    <label for="show">Pouvoir ajouter un item</label>
                </div>

                <p class="font-bold">Paramétrage de chaque champ</p>

                <div>
                    @foreach ($parametres->champs as $col => $champ)
                        <div class="my-3 bg-slate-200 border-2 p-3">
                            <p class="font-bold">{{ $champ->label }}</p>
                            <div class="grid grid-cols-3 gap-3">

                                <div class="my-2 flex flex-col gap-1">
                                    <label for="type">Type de champ</label>
                                    <select name="{{ $col }}_type" id="type">
                                        @foreach ($inputs as $input => $intitule)
                                            <option @if ($input == $champ->type) selected @endif
                                                value="{{ $input }}">
                                                {{ $intitule }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-2 flex flex-col gap-1">
                                    <label for="field">Nom de la colonne dans la bdd</label>
                                    <input id="field" class="bg-slate-200" type="text" name="{{ $col }}_field" disabled
                                        value="{{ $champ->field }}">
                                </div>
                                <div class="my-2 flex flex-col gap-1">
                                    <label for="label">Intitulé de ce champ</label>
                                    <input id="label" type="text" name="{{ $col }}_label" value="{{ $champ->label }}">
                                </div>
                                <div class="my-2 flex flex-col gap-1">
                                    <label for="rules">Règles ( séparer chaque règle par | )</label>
                                    <input id="rules" type="text" name="{{ $col }}_rules" value="{{ $champ->rules }}">
                                </div>
                                <div class="my-2 flex flex-col gap-1">
                                    <label for="align">Alignement dans le tableau</label>
                                    <select name="{{ $col }}_align" id="align">
                                        <option @if ($champ->align == 'left') selected @endif value="left">Gauche
                                        </option>
                                        <option @if ($champ->align == 'center') selected @endif value="center">Centre
                                        </option>
                                        <option @if ($champ->align == 'right') selected @endif value="right">Droit
                                        </option>
                                    </select>
                                </div>
                                <div class="my-2 flex flex-col gap-1">
                                    <label for="label">Affichage dans le tableau</label>
                                    <select name="{{ $col }}_onTable" id="onTable">
                                        <option @if ($champ->onTable == 1) selected @endif value="1">Oui
                                        </option>
                                        <option @if ($champ->onTable == 0) selected @endif value="0">Non
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="my-2 bg-slate-300 p-2 grid grid-cols-3 gap-2">
                                @if ($champ->type == 'select')
                                    <div class="my-2 flex flex-col gap-1">
                                        <label for="table">Table de la liste déroulante</label>
                                        <input id="table" type="text" name="{{ $col }}_table" value="{{ $champ->table }}">
                                    </div>
                                    <div class="my-2 flex flex-col gap-1">
                                        <label for="belongsTo">Modèle correspondant</label>
                                        <input id="belongsTo" type="text" name="{{ $col }}_belongsTo"
                                            value="{{ $champ->belongsTo }}">
                                    </div>
                                    <div class="my-2 flex flex-col gap-1">
                                        <label for="coltable">Champ de la table</label>
                                        <input id="coltable" type="text" name="{{ $col }}_coltable"
                                            value="{{ $champ->coltable }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <x-buttons.success-button>Enregistrer</x-buttons.success-button>
        </form>
    </div>

</x-app-layout>
