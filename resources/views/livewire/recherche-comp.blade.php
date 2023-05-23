<div x-data="{ state: @entangle('state') }" class="grid grid-cols-4 gap-2">

    <div class="py-2">
        {{-- Choix de la table dans lequel on va rechercher les enregisterements --}}
        <div class="flex flex-row justify-start gap-2" x-data="{ model: @entangle('model') }">

            <button class="btn bg-orange-500 " wire:click="modele('Contenu')">Contenu</button>
            <button class="btn bg-green-500 " wire:click="modele('Source')">Sources</button>
            <button class="btn bg-blue-500 " wire:click="modele('Brutesdata')">Données brutes</button>

        </div>
        {{-- Choix des colonnes à retenir de la table sélectionnée --}}
        <div>
            @isset($columns)
                <ul>
                    <h3 class="text-lg font-bold">Champs à afficher:</h3>
                    @foreach ($selectedColumns as $field => $detail)
                        <li>

                            <input type="checkbox" wire:change="selectColumns('{{ $field }}')"
                                @if ($detail['visible']) checked @endif>
                            {{ $detail['label'] }}

                        </li>
                    @endforeach
                </ul>
            @endisset

        </div>

        <div x-data="{ localisation: false }" class="my-5">

            <button class="btn bg-slate-500" x-on:click="localisation = !localisation">Localisations</button>
            <ul class="my-2" x-cloak x-show='localisation'>

                <li>
                    <input type="radio" name="Localisation"
                            wire:change="toggleValues('Localisation', 'all')"
                            ><span class="font-bold">
                        Toutes</span>
                </li>
                <li>
                    <input type="radio" name="Localisation"
                            wire:change="toggleValues('Localisation', 'none')"
                            ><span class="font-bold">
                        Aucunes</span>
                </li>
                <hr class="my-3">
                @foreach ($localisations as $localisation)
                    <li>
                        <input type="checkbox" wire:change="addValue('Localisation', {{$localisation->id}})"
                            value="{{ $localisation }}"
                            @isset($choices['Localisation'])
                                @if (in_array($localisation->id, $choices['Localisation']))
                                    checked
                                @endif
                            @endisset>
                        {{ $localisation->nom }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    {{-- Affichage les résulats de la recherche --}}
    <div class="col-span-3">
        @isset($subject)
            <div class="flex flex-row gap-2 bg-yellow-900 rounded-md px-3 mb-2">
                <img class="w-8" src="{{ url('storage/img/icones/' . $subject['icone'] ?? 'default.svg') }}"
                    alt="icone">
                <h2 class="h2 p-3 text-gray-200">{{ $subject['titre'] ?? 'Recherche' }} ({{ $records->count() }})</h2>
            </div>
        @else
            <div class="flex flex-row gap-2   px-3 mb-2">
                <img class="w-8" src="{{ url('storage/img/icones/fleche_gauche.svg') }}" alt="fleche">
                <h2 class="h2 p-3">Choisir un type de données en cliquant sur un des boutons</h2>
            </div>
        @endisset

        <ul>
            @isset($records)
                @foreach ($records as $record)
                    <li class="mb-3 border-y-2 p-3 bg-yellow-50">
                        @foreach ($selectedColumns as $column => $detail)
                            {{-- On n'affiche que les champs avec l'attribut visible (checkbox) --}}
                            @if ($detail['visible'])
                                <div>
                                    {{-- Si on a un lien vers une autre table on affiche la valeur correspondante --}}
                                    @if ($detail['type'] == 'select')
                                        {{-- Pas d'affichage si valeur nulle --}}
                                        @if ($record->{$detail['belongsTo']} != null)
                                            <span class="italic text-gray-500">{{ $detail['label'] }} : </span>
                                            {{ $record->{$detail['belongsTo']}->{$detail['coltable']} ?? '' }}
                                        @endif
                                        {{-- Si champs date on formate la date --}}
                                    @elseif ($detail['type'] == 'date')
                                        @if ($record->column != null)
                                            <span class="italic text-gray-500">{{ $detail['label'] }} : </span>
                                            {{ date('d/m/Y', strtotime($record->$column)) }}
                                        @endif
                                    @elseif ($detail['type'] == 'text')
                                        @if ($record->$column != null)
                                            <span class="italic text-gray-500">{{ $detail['label'] }} : </span>
                                            {{ $record->$column }}
                                        @endif
                                    @else
                                        @if ($record->column != null)
                                            <span class="italic text-gray-500">{{ $detail['label'] }} : </span>
                                            {{ $record->$column }}
                                        @endif
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </li>
                @endforeach
            @endisset
        </ul>
    </div>

</div>
