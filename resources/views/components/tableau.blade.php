<div class="my-3">
    <table class="w-full border-2">
        <thead class="bg-slate-900 text-white">
            @foreach ($titres as $titre)
                @if ($titre['onTable'])
                    <th class="border-2 border-white">{{ $titre['label'] }}</th>
                @endif
            @endforeach
            @if ($show)
                <th class="border-2 border-white">Voir</th>
            @endif
            <th class="border-2 border-white">Modif.</th>
            <th class="border-2 border-white">Supp.</th>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="border-2">
                    @foreach ($champs as $field => $champ)
                        @if ($champ['onTable'])
                            @if ($champ['type'] == 'select')
                                <td class="p-2 border-2 text-{{ $champ['align'] }}">
                                    {{ ucfirst($item->{$champ['belongsTo']}->{$champ['coltable']}) }}
                                </td>
                            @elseif ($champ['type'] == 'date')
                                <td class="p-2 border-2 text-{{ $champ['align'] }}">{{ date('d/m/Y', strtotime($item->$field)) }} </td>
                            @else
                                <td class="p-2 border-2 text-{{ $champ['align'] }}">{{ $item->$field }} </td>
                            @endif
                        @endif
                    @endforeach

                    @if ($show)
                        <td class="p-2 border-2 text-center">
                            <button>
                                <x-buttons.see-small-button x-on:click="see = true"
                                    wire:click.prevent="show({{ $item->id }})">
                                </x-buttons.see-small-button>
                            </button>
                        </td>
                    @endif

                    <td class="p-2 border-2 text-center">
                        <button>
                            <x-buttons.edit-small-button x-on:click="show = !show, see = false"
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
