<x-app-layout>
    <div class="my-8 flex flex-col gap-5 w-1/2 m-auto bg-red-500 p-8">
        <h1 class="text-white h1">
            Désolé... Cet item n'a pas encore été configuré !

        </h1>
            <x-buttons.cancel-button :route="route('dev.index')">Retour</x-buttons.cancel-button>
    </div>
</x-app-layout>