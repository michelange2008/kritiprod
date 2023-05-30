<div>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $contenu->description }}
        </h2>
    </x-slot>

    <div class="my-3">
        <div class="p-3 col-span-2 text-xl">
            <p>{{ $contenu->formalisees }} </p>
        </div>

        <div class="flex flex-col sm:grid sm:grid-flow-col-dense gap-3">
            <div class="border-2 p-2">
                <p class="italic">localisation</p>
                <p class="text-xl font-bold">{{ $contenu->localisation->nom }}</p>
                <img class="w-48" src="{{ url('storage/img/cartes/' . $contenu->localisation->carte) }}" alt="">
            </div>
            <div class="border-2 p-2">
                <p class="italic">Période:</p>
                <p class="text-xl font-bold">{{ $contenu->periode->nom }} </p>
            </div>
            <div class="border-2 p-2">
                <p class="italic">Type de données: </p>
                <p class="text-xl font-bold">
                    {{ $contenu->soustype->type->nom }}
                    ({{ $contenu->soustype->nom }})
                </p>
                </p>
            </div>
        </div>

        <div class="my-3">
            <div class="px-2 py-3 bg-gray-700">
                <p class="text-white text-xl">Source:</p>
            </div>
            <div>
                <p>{{ $contenu->source->auteur}} </p>
                <p>{{ $contenu->source->annee}} </p>
                <p>{{ $contenu->source->nom}} </p>
                <p>{{ $contenu->source->reference}} </p>
                <p>{{ $contenu->source->lien}} </p>
            </div>

        </div>

    </div>



</div>
