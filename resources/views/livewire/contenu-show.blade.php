<div>

    <div class="my-3 p-3 bg-teal-800">
        <h2 class="font-semibold text-2xl text-teal-100 leading-tight">
            {{ $contenu->description }}
        </h2>
    </div>

    <div class="my-3">
        <div class="p-3 col-span-2 text-xl text-teal-900">
            <p>{{ $contenu->formalisees }} </p>
        </div>

        <div class="flex flex-col sm:grid sm:grid-flow-col-dense gap-3">
            <div class="border-2 p-2">
                <p class="italic text-gray-600">localisation</p>
                <p class="text-xl font-bold text-teal-800">{{ $contenu->localisation->nom }}</p>
                <img class="w-48" src="{{ url('storage/img/cartes/' . $contenu->localisation->carte) }}" alt="">
            </div>
            <div class="border-2 p-2">
                <p class="italic text-gray-600">Période:</p>
                <p class="text-xl font-bold text-teal-800">{{ $contenu->periode->nom }} </p>
            </div>
            <div class="border-2 p-2">
                <p class="italic text-gray-600">Type de données: </p>
                <p class="text-xl font-bold text-teal-800">
                    {{ $contenu->soustype->type->nom }}
                    ({{ $contenu->soustype->nom }})
                </p>
                </p>
            </div>
        </div>

        <div class="my-5">
            <div class="px-2 py-3 bg-rose-800">
                <p class="text-white text-xl">Sources</p>
            </div>
            <div class="my-3 p-2 bg-rose-100">
                <p class="font-bold text-xl">{{ $contenu->source->auteur }} </p>
                <p class="italic text-base">{{ $contenu->source->annee }} </p>
                <p class="font-semibold base">{{ $contenu->source->nom }} </p>
                <div class="my-2 p-3 border-2">
                    <p class="italic">Référence complète:</p>
                    <p>{{ $contenu->source->reference }} </p>
                    <a class="inline-block my-3 text-sky-900 hover:font-semibold visited:text-violet-900"
                        href="{{ $contenu->source->lien }}">{{ $contenu->source->lien }}</a>
                </div>
            </div>

        </div>

        <div class="my-5">

            <div class="px-2 py-3 bg-orange-800">
                <p class="text-white text-xl">Données brutes</p>
            </div>

            @foreach ($brutesdatas as $brutesdata)
                <div class="p-3 mt-3 bg-orange-300">
                    <p class="font-bold">{{ $brutesdata->naturedatas }}</p>
                </div>
                <div class="p-3 bg-orange-200">
                    <div class="my-1">
                        <p class="text-xl font-bold text-orange-800">{{ $brutesdata->application->nom }}</p>
                    </div>
                    @if ($brutesdata->qualite != null)
                        <p><span class="italic">Qualité: </span>{{ $brutesdata->qualite }}</p>
                    @endif
                    @if ($brutesdata->adventices)
                        <img src="{{ url('storage/img/icones/adventices.svg')}}" alt="adventices">                        
                    @endif
                    <div
                        class="grid grid-cols-3 gap-3 my-2 py-2 border-t-2 border-orange-800 divide-x-2 divide-orange-800">
                        <div class="flex flex-col items-center gap-2">
                            <p>{{ $brutesdata->brutetype->nom }}</p>
                            <img class="w-12 inline-block"
                                src="{{ url('storage/img/icones/' . $brutesdata->brutetype->icone) }}"
                                alt="{{ $brutesdata->brutetype->icone }}">
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <p>{{ $brutesdata->accessible->nom }}</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <p>{{ $brutesdata->format->nom }}</p>
                            <img class="w-12" src="{{ url('storage/img/icones/' . $brutesdata->format->icone) }}"
                                alt="{{ $brutesdata->format->icone }}">
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    </div>



</div>
