<div class="my-3" x-data="{ show: @entangle('change'), update: @entangle('updateMode') }">

    <x-titres.titre :icone="$icone">{{ $titre }}</x-titres.titre>

    <x-flash></x-flash>
    
    <x-search></x-search>

    {{-- Tableau des items --}}
    <x-tableau :items="$items" :champs="$champs" :titres="$titres"></x-tableau>

    {{-- Bouton rond situé au bas à droite de l'écran pour ajouter un item --}}
    <x-buttons.success-round wire:click="addModal"></x-buttons.success-round>

    {{-- fenêtre modale qui affiche le formulaire pour ajouter ou modifier un item --}}
    <x-modal-custom>

        <form>
            <x-titres.group-titre :updateMode="$updateMode"></x-titres.group-titre>

            @foreach ($champs as $champ)

                @if ($champ['type'] == 'text')

                    <x-forms.input-text :label="$champ['label']" :field="$champ['field']"></x-forms.input-text>

                @elseif ($champ['type'] == 'select')
                    <div class = "flex flex-col my-2">
                        <label for="{{ $champ['field'] }}">{{ $champ['label'] }}</label>
                        <select  id="{{ $champ['field'] }}" wire:model.defer="{{ 'state.'.$champ['field'] }}">
                            {{-- <option disabled selected value="">Choisir une valeur dans la liste ...</option> --}}
                            @foreach ($champ['options'] as $id => $option)
                            <option value="{{ $id }}">{{ ucFirst($option) }} </option>
                            @endforeach
                        </select>
                    </div>

                @endif

            @endforeach

            <x-buttons.group-button :updateMode="$updateMode"></x-buttons.group-button>

        </form>

    </x-modal-custom>

</div>
