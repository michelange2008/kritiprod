<div class="my-3" x-data="{ show: @entangle('showModal') }">
    <x-titres.titre icone="accessible.svg">Accessibilité</x-titres.titre>
    <div>
        @if (session()->has('message'))
            <div class="my-3 p-3 h2 bg-green-400">{{ session('message') }}</div>
        @endif
    </div>

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
                                    x-on:click.prevent="$dispatch('open-modal', 'edit_{{ $accessible->id }}')"
                                    ></x-buttons.edit-small-button>
                            </button>
                        </td>
                        <td class="p-2 border-2 text-center ">
                            <x-buttons.del-small-button
                                x-on:click.prevent="$dispatch('open-modal', 'del_{{ $accessible->id }}')"
                                ></x-buttons.del-small-button>
                        </td>
                    </tr>
                    {{-- Modal pour la modification d'un item --}}

                        <x-modal-custom name="edit_{{ $accessible->id }}">
                            <div class="flex flex-col justify-between bg-orange-200 p-5">
                                <x-titres.titre1 icone="edit.svg">Modification</x-titres.titre1>

                                <form action="" wire:submit.prevent="update">

                                    <x-forms.input-text label="nom" model="accessible.nom"></x-forms.input-text>

                                    <div class="flex flex-row gap-1">
                                        <x-buttons.success-button>
                                            <x-icones.save></x-icones.save> Enregistrer
                                        </x-buttons.success-button>
                                        <x-buttons.cancel-button x-on:click="show = false">
                                            <x-icones.return></x-icones.return> Annuler
                                        </x-buttons.cancel-button>
                                    </div>
                                </form>
                            </div>
                        </x-modal-custom>


                        <x-modal-custom name="del_{{ $accessible->id }}">
                            <div class="flex flex-col justify-between bg-gray-200 p-5">
                                <x-titres.titre1 icone="del.svg">Suppression</x-titres.titre1>
                                <div class="my-3 p-5 text-xl">
                                    <p>Faut-il vraiment supprimer cet item ?</p>
                                </div>
                                <form action="" wire:submit.prevent="delete({{ $accessible->id }})">
                                    <div class="flex gap-2">
                                        <x-buttons.danger-button>Oui... supprimer</x-buttons.danger-button>
                                        <x-buttons.cancel-button x-on:click="show = false">Non !!!</x-buttons.cancel-button>
                                    </div>

                                </form>
                            </div>
                        </x-modal-custom>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal pour la création d'un nouvel item --}}
    <x-modal-custom name="create">
        <div class="flex flex-col justify-between bg-orange-200 p-5">
            <x-titres.titre1 icone="add.svg">Nouveau type d'accessibilité</x-titres.titre1>

            <form action="" wire:submit.prevent="create">
                <x-forms.input-text :class="'basis-1/2'" label="Nom" model="accessible.nom">
                </x-forms.input-text>

                <x-buttons.success-button>
                    <x-icones.save></x-icones.save> Enregistrer
                </x-buttons.success-button>
                <x-buttons.cancel-button x-on:click="show = false">
                    <x-icones.return></x-icones.return> Annuler
                </x-buttons.cancel-button>

            </form>
        </div>
    </x-modal-custom>


</div>
