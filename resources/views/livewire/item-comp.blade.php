<div class="my-3" x-data="{ show: @entangle('change'), update: @entangle('updateMode') }">

    <x-titres.titre :icone="$icone">{{ $titre }}</x-titres.titre>

    <x-flash></x-flash>
    
    <div class="my-3 flex gap-3 items-center">
        <p>Rechercher</p>
        <input class="grow" type="text" wire:model.debounce.500ms="search">
        <button class=" flex items-center place-self-auto border-black border" wire:click='resetSearch'>
            <img class="w-10 p-1" src="{{ url('storage/img/icones/reset.svg')}}" alt="reset">
        </button>
    </div>

    {{-- Tableau des items --}}
    <x-tableau :items="$items" :titres="$titres"></x-tableau>

    {{-- Bouton rond situé au bas à droite de l'écran pour ajouter un item --}}
    <x-buttons.success-round wire:click="addModal"></x-buttons.success-round>

    {{-- fenêtre modale qui affiche le formulaire pour ajouter ou modifier un item --}}
    <x-modal-custom>

        <form>
            <x-titres.group-titre :updateMode="$updateMode"></x-titres.group-titre>

            @foreach ($champs as $champ)

                @if ($champ['type'] == 'text')

                    <x-forms.input-text :label="$champ['label']" :field="$champ['field']"></x-forms.input-text>

                @endif

            @endforeach

            <x-buttons.group-button :updateMode="$updateMode"></x-buttons.group-button>

        </form>

    </x-modal-custom>

</div>
