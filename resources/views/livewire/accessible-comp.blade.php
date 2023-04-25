<div class="my-3" x-data="{ show: false }">
    <x-titres.titre icone="accessible.svg">Accessibilité</x-titres.titre>

    <div class="my-3">
        <x-buttons.success-round x-on:click.prevent="$dispatch('open-modal', 'create')"></x-buttons.success-round>
        <table class="w-full border-2">
            <thead class="bg-slate-900 text-white">
                <th class="border-2 border-white">Id</th>
                <th class="border-2 border-white">Nom</th>
                <th class="border-2 border-white">Modifier</th>
                <th class="border-2 border-white">Supprimer</th>
            </thead>
            <tbody>
                @foreach ($accessibles as $accessible)
                    <tr class="border-2">
                        <td class="p-2 border-2">{{ $accessible->id }} </td>
                        <td class="p-2 border-2">{{ $accessible->nom }} </td>
                        <td class="p-2 border-2 text-center">
                            <button>
                                <x-buttons.edit-small-button
                                    x-on:click.prevent="$dispatch('open-modal', '{{ $accessible->id }}')">
                                </x-buttons.edit-small-button>
                            </button>
                        </td>
                        <td class="p-2 border-2 text-center ">
                            <x-buttons.del-small-button></x-buttons.del-small-button>
                        </td>
                    </tr>
                    {{-- Modal pour la modification d'un item --}}
                    <div>
                        <x-modal-custom name="{{ $accessible->id }}">
                            <div class="flex flex-col justify-between bg-orange-200 p-5">
                                <x-titres.titre1 icone="edit.svg">Modification</x-titres.titre1>

                                <form action="" wire:submit.prevent="edit">

                                    <input type="text" wire:model.defer="accessible.nom" value="{{ $accessible->nom}}">

                                    <div class="flex flex-row gap-1">
                                        <x-buttons.success-button x-on:click="show = false">
                                            <x-icones.save></x-icones.save> Enregistrer
                                        </x-buttons.success-button>
                                        <x-buttons.cancel-button x-on:click="show = false">
                                            <x-icones.return></x-icones.return> Annuler
                                        </x-buttons.cancel-button>
                                    </div>
                                </form>
                            </div>
                        </x-modal-custom>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal pour la création d'un nouvel item --}}
    <x-modal-custom name="create">
        <div class="flex flex-col justify-between bg-orange-200 p-5">
            <x-titres.titre1 icone="add.svg">Nouveau type d'accessibilité</x-titres.titre1>

            <form action="" wire:submit.prevent="create">
                <x-forms.input-text :class="'basis-1/2'" name="Nom" id="nom" model="accessible">
                </x-forms.input-text>

                <x-buttons.success-button x-on:click="show = false">
                    <x-icones.save></x-icones.save> Enregistrer
                </x-buttons.success-button>
            </form>
        </div>
    </x-modal-custom>


</div>
