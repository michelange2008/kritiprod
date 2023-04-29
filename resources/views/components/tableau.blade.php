<div class="my-3">
    <table class="w-full border-2">
        <thead class="bg-slate-900 text-white">
            @foreach ($titres as $titre)
                <th class="border-2 border-white">{{ $titre }}</th>
            @endforeach
            <th class="border-2 border-white">Modifier</th>
            <th class="border-2 border-white">Supprimer</th>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="border-2">
                    <td class="p-2 border-2">{{ $item->id }} </td>
                    <td class="p-2 border-2">
                        {{ $item->nom }}
                    </td>
                    <td class="p-2 border-2 text-center">
                        <button>
                            <x-buttons.edit-small-button x-on:click="show = !show"
                                wire:click.prevent="edit({{ $item->id }})">
                            </x-buttons.edit-small-button>
                        </button>
                    </td>
                    <td class="p-2 border-2 text-center ">
                        <x-buttons.del-small-button
                            onclick="confirm('Sûr de vouloir supprimmer cet item ?') || event.stopImmediatePropagation()"
                            wire:click.prevent="delete({{ $item->id }})">
                        </x-buttons.del-small-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
