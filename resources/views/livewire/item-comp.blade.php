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
                @if ($champ['type'] == 'select')

                    <x-forms.select :label="$champ['label']" :field="$champ['field']" :options="$champ['options']"></x-forms.select>

                @elseif ($champ['type'] == 'textarea')

                @elseif ($champ['type'] == 'checkbox')

                @elseif ($champ['type'] == 'radio')

                @elseif ($champ['type'] == 'file')

                {{-- @elseif ($champ['type'] == 'number') --}}

                @elseif ($champ['type'] == 'password')

                @else
                    <x-forms.input-text :type="$champ['type']" :label="$champ['label']" :field="$champ['field']"></x-forms.input-text>
                @endif
            @endforeach

            <x-buttons.group-button :updateMode="$updateMode"></x-buttons.group-button>

        </form>

    </x-modal-custom>

</div>
