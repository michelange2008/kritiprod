<div>
    <button class="rounded my-1 px-3 py-1 text-center bg-teal-900 text-teal-100 disabled:bg-gray-500" type="submit"
        wire:loading.attr="disabled" x-on:click="show = false">
        Enregistrer
    </button>

    <button
        class="rounded my-1 px-3 py-1 text-center bg-gray-300 hover:bg-gray-800 hover:text-gray-200" type="cancel"
        x-on:click="show = false">
        Annuler
    </button>
</div>
