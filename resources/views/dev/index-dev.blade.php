<x-app-layout>

    <x-titres.titre :icone="'liste.svg'">Liste des items</x-titres.titre>

    <div>
        <table class="w-full">
            <thead class="bg-teal-900 text-white">
                <th class="text-left p-3">Intitulé</th>
                <th class="text-left p-3">Description</th>
                <th class="p-3">Paramétrer</th>
            </thead>
            <tbody>
                @foreach ($modeles as $modele)
                    <tr class="hover:bg-teal-200 transition-all">
                        <td class="p-3">{{ $modele->nom }} </td>
                        <td></td>
                        <td class="text-center">
                            @if ($modele->hasJson)
                            <a href="{{ route('dev.show', $modele->model)}}">
                                <x-buttons.see-small-button></x-buttons.see-small-button>
                            </a>
                            @else
                            <a href="{{ route('dev.add', $modele->model)}}">
                                <x-buttons.add-small-button></x-buttons.add-small-button>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</x-app-layout>
