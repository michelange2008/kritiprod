<x-app-layout>

    <x-titres.titre :icone="$parametres->icone">Paramétrage de "{{ $model }}" </x-titres.titre>

    <div class="p-3">
        <form action="{{ route('dev.update', $model) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="font-bold">Paramétrage global</p>
            <div class="grid sm:grid-cols-2 gap-3">
                <div>
                    <x-forms.input-classic class="border-2 p-2" :name="'titre'" :label="'Intitulé de l\'item'" :value="$parametres->titre">
                    </x-forms.input-classic>

                    <x-forms.input-checkbox-classic name="show" label="Pouvoir afficher les détails" :checked="$parametres->show">
                    </x-forms.input-checkbox-classic>

                    <x-forms.input-checkbox-classic name="add" label="Pouvoir ajouter un item" :checked="$parametres->add">
                    </x-forms.input-checkbox-classic>
                </div>

                <x-forms.input-file-classic class="border-2 p-2" :label="'Icone de l\'item'">
                </x-forms.input-file-classic>

                <hr class="border-t-4 border-gray-500 my-3">
                <p class="font-bold">Paramétrage de chaque champ</p>

                <div>
                    @foreach ($parametres->champs as $col => $champ)
                        <div class="my-3 bg-slate-200 border-2 p-3">
                            <p class="font-bold">{{ $champ->label }}</p>

                            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-3">
                                <x-forms.select-classic :name="$col . '_type'" label="Type de champ" :options="\CONST::INPUT_TYPES"
                                    :selected="$champ->type">
                                </x-forms.select-classic>

                                <x-forms.input-classic :name="$col . '_field'" label="Nom de la colonne dans la bdd"
                                    :value="$champ->field" disabled=true>
                                </x-forms.input-classic>

                                <x-forms.input-classic :name="$col . '_label'" label="Intitulé de ce champ"
                                    :value="$champ->label">
                                </x-forms.input-classic>

                                <x-forms.input-classic :name="$col . '_rules'" label="Règles (| séparateur)"
                                    :value="$champ->rules">
                                </x-forms.input-classic>

                                <x-forms.select-classic :name="$col . '_align'" label="Alignement dans le tableau"
                                    :options="\CONST::ALIGN" :selected="$champ->align">
                                </x-forms.select-classic>

                                <x-forms.select-classic :name="$col . '_onTable'" label="Affichage dans le tableau"
                                    :options="\CONST::OUI_NON" :selected="$champ->onTable">
                                </x-forms.select-classic>
                            </div>

                            <div class="my-2 bg-slate-300 p-2 grid grid-cols-3 gap-2">
                                @if ($champ->type == 'select')
                                    <x-forms.input-classic :name="$col . '_table'" :label="'Table de la liste déroulante'" :value="$champ->table">
                                    </x-forms.input-classic>

                                    <x-forms.input-classic :name="$col . '_belongsTo'" :label="'Modèle correspondant'" :value="$champ->belongsTo">
                                    </x-forms.input-classic>

                                    <x-forms.input-classic :name="$col . '_coltable'" :label="'Champ de la table'" :value="$champ->coltable">
                                    </x-forms.input-classic>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <x-buttons.success-button class="mx-3">
                <x-icones.save></x-icones.save> Enregistrer
            </x-buttons.success-button>
            <x-buttons.cancel-button :route="route('dev.index')">
                <x-icones.return></x-icones.return> Annuler
            </x-buttons.cancel-button>
        </form>
    </div>

</x-app-layout>
