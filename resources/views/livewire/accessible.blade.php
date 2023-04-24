<div class="my-3">
    <x-titres.titre>Accessibilité</x-titres.titre>

    <div class="my-3">
        <x-buttons.success-round></x-buttons.success-round>
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
                    <td class="p-2 border-2">{{ $accessible->id}} </td>
                    <td class="p-2 border-2">{{ $accessible->nom}} </td>
                    <td class="p-2 border-2">edit </td>
                    <td class="p-2 border-2">del</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
