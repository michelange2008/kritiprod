<div>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $contenu->description }}
        </h2>
    </x-slot>

    <img src="{{ url('storage/img/cartes/'.$contenu->localisation->carte) }}" alt="">


</div>
