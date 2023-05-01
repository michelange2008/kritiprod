<div class="my-3 flex gap-3 items-center" wire:keydown.escape='resetSearch'>
    <p>Rechercher:</p>
    <input class="grow rounded-md" type="text" wire:model.debounce.500ms="search" placeholder="Tapez quelques lettres">
    <button class=" flex items-center place-self-auto border-black border rounded-md hover:bg-gray-700 focus:bg-black group" 
            wire:click='resetSearch'>
        <img class="w-10 p-3 group-hover:invert group-focus:invert" src="{{ url('storage/img/icones/reset.svg')}}" alt="reset">
    </button>
</div>
