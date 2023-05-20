<div x-data="{ state: @entangle('state') }" class="grid grid-cols-9 gap-2">

    <div class="py-2">
        <div class="flex flex-col gap-2" x-data="{ model: @entangle('model') }">

            <button class="btn bg-orange-500" wire:click="modele('Contenu')">Contenu</button>
            <button class="btn bg-green-500" wire:click="modele('Source')">Sources</button>

            @isset($columns)
                @foreach ($columns as $column)
                    {{ $column }}
                @endforeach
            @endisset
        </div>
    </div>

    <div class="py-2 col-span-2">
        <div class="flex flex-col gap-2">

            <x-forms.select-model label="Localisation" model="localisation" :options="$localisations" size=10>
            </x-forms.select-model>

            <x-forms.select-model label="Périodes" model="periode" :options="$periodes"></x-forms.select-model>
        </div>
        {{-- @isset($contenus)
            <ul>
    
                @foreach ($contenus as $contenu)
                <li>
    
                    {{ $contenu->description }}
                </li>
                @endforeach
            </ul>
        @endisset --}}
        @isset($contenus)
            <ul>

                @foreach ($state as $item)
                    <li>

                        {{ $item }}
                    </li>
                @endforeach
            </ul>
        @endisset

    </div>
    <div class="col-span-6 bg-yellow-50">
        <h2 class="h2">Résultat de la recherche</h2>
        <ul>

            @isset($records)
            
            @foreach ($records as $record)
            <li>
                @foreach ($columns as $column)
                    @if (count(explode('_', $column)) == 2)
                    {{ $record->{explode('_', $column)[0]}->nom}}
                    @else
                        
                    {{ $record->$column }}
                    @endif
                @endforeach
            </li>
            @endforeach
            @endisset
        </ul>
    </div>

</div>
