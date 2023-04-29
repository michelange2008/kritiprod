<div {{ $attributes->merge([
    'class' => 'mt-3',
]) }}>
    @if ($updateMode)
        <x-buttons.success-button wire:click.prevent="update">
            <x-icones.edit></x-icones.edit> Mettre à jour
        </x-buttons.success-button>
        <x-buttons.reset-button x-on:click="show = !show" wire:click="cancel">
            <x-icones.return></x-icones.return> Annuler
        </x-buttons.reset-button>
    @else
        <x-buttons.success-button wire:click.prevent="store">
            <x-icones.add></x-icones.add> Ajouter
        </x-buttons.success-button>
        <x-buttons.reset-button x-on:click="show = !show" wire:click="cancel">
            <x-icones.return></x-icones.return> Annuler
        </x-buttons.reset-button>
    @endif
</div>
