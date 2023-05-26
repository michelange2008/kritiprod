<div x-data="{ choices: @entangle('choices') }">

    <div class="flex flex-row justify-start gap-4 mb-3" x-data="{ model: @entangle('model') }">

        {{-- Choix de la table dans lequel on va rechercher les enregisterements --}}
        @foreach (Storage::json('public/json/main_models.json') as $model)
            <div class="flex flex-row gap-2 p-5  bg-lime-700 ">
                <img class="w-8" src="{{ url('storage/img/icones/' . $model['icone']) }}" alt="">
                <button class="btn" wire:click="selectModel('{{ $model['model'] }}')">{{ $model['label'] }}</button>
            </div>
        @endforeach

    </div>
    <div class="grid grid-cols-4 gap-2">

        <div class="py-2">
            {{-- Choix des colonnes à retenir de la table sélectionnée --}}
            <div>
                @isset($columns)
                    <ul>
                        <h3 class="text-lg font-bold">@lang('commun.fieldsToDisplay')</h3>
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

            <div x-data="{ visible: @entangle('toggleList') }" class="my-5 flex flex-col gap-2">
                @if (count($linkedModels) > 0)
                    <h3 class="text-lg font-bold">@lang('commun.recordsToDisplay')</h3>
                    @foreach ($linkedModels as $linkedModel)
                        <div>

                            <button class="btn bg-slate-500"
                                x-on:click="visible['{{ $linkedModel['model'] }}'] = !visible['{{ $linkedModel['model'] }}']">{{ $linkedModel['label'] }}
                            </button>
                            <ul class="my-2" x-cloak x-show="visible['{{ $linkedModel['model'] }}']">

                                <li>
                                    <input type="radio" name="{{ $linkedModel['model'] }}"
                                        wire:change="allValues( '{{ $linkedModel['model'] }}', true)"
                                        @if ($choices[$linkedModel['model']]['all']) checked @endif><span class="font-bold">
                                        Toutes</span>
                                </li>
                                <li>
                                    <input type="radio" name="{{ $linkedModel['model'] }}"
                                        wire:change="allValues( '{{ $linkedModel['model'] }}', false)"><span
                                        class="font-bold">
                                        Aucunes</span>
                                </li>
                                <hr class="my-3">

                                @foreach ($linkedModel['datas'] as $data)
                                    <li>
                                        <input type="checkbox"
                                            wire:change="toggleValue('{{ $linkedModel['model'] }}', {{ $data['id'] }})"
                                            @if ($choices[$linkedModel['model']][$data['id']]) checked
                                    @else @endif>
                                        {{ $data[$linkedModel['coltable']] }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        {{-- Affichage les résulats de la recherche --}}
        <div class="col-span-3">
            @isset($modelInfosFromJson)
                <div class="flex flex-row gap-2 bg-yellow-900 rounded-md px-3 mb-2">
                    <img class="w-8"
                        src="{{ url('storage/img/icones/' . $modelInfosFromJson['icone'] ?? 'default.svg') }}"
                        alt="icone">
                    <h2 class="h2 p-3 text-gray-200">{{ $modelInfosFromJson['titre'] ?? 'Recherche' }}
                        ({{ $records->count() }})</h2>
                </div>

                <div class="my-3 flex gap-3 items-center" wire:keydown.escape='resetSearch'>
                    <p>Rechercher:</p>
                    <input class="grow rounded-md" type="text" wire:model.debounce.500ms="search"
                        placeholder="Tapez quelques lettres">
                    <button
                        class=" flex items-center place-self-auto border-black border rounded-md hover:bg-gray-700 focus:bg-black group"
                        wire:click='resetSearch'>
                        <img class="w-10 p-3 group-hover:invert group-focus:invert"
                            src="{{ url('storage/img/icones/reset.svg') }}" alt="reset">
                    </button>
                </div>

            @else
                <div class="flex flex-row gap-2   px-3 mb-2">
                    <img class="w-8" src="{{ url('storage/img/icones/fleche_gauche.svg') }}" alt="fleche">
                    <h2 class="h2 p-3">@lang('commun.chooseTable')</h2>
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

</div>
