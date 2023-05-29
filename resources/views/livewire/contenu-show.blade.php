<div>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $contenu->description }}
        </h2>
    </x-slot>

    <img class="w-48" src="{{ url('storage/img/cartes/'.$contenu->localisation->carte) }}" alt="">

        {{ $contenu->soustype->type->nom}}
        {{ $contenu->soustype->nom}}

</div>
