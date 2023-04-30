<div class="my-3" x-data="{ show: @entangle('change'), update: @entangle('updateMode') }">

    <x-titres.titre :icone="$icone">{{ $titre}}</x-titres.titre>

    <x-flash></x-flash>
    
    <x-buttons.success-round wire:click="addModal"></x-buttons.success-round>

    <x-modal-custom>

        <form>
            <x-titres.group-titre :updateMode="$updateMode"></x-titres.group-titre>

            <x-forms.input-text label='Nom' field='nom'></x-forms.input-text>

            <x-buttons.group-button :updateMode="$updateMode"></x-buttons.group-button>
        </form>

    </x-modal-custom>

    <x-tableau :items="$applications" :titres="$titres" ></x-tableau>

</div>
