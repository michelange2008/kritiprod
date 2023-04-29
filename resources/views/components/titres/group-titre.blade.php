<div>
    @if ($updateMode)
        <x-titres.titre1 :icone="'edit.svg'">Modifier un item</x-titres.titre1>
    @else
        <x-titres.titre1 :icone="'add.svg'">Ajouter un item</x-titres.titre1>
    @endif
</div>
