<x-app-layout>

    <x-titres.titre :icone="'menus.svg'">Gestion des menus</x-titres.titre>

    <div>
        <div class="my-3 grid grid-cols-2 gap-2">
            @foreach (\Storage::json('public/json/menus.json') as $menu)
            <ul class="bg-gray-200 p-5">

                <x-forms.input-classic label="" :field="$menu['file']" :value="$menu['nom']"></x-forms.input-classic>
                @php
                    $i = 1;
                @endphp
                @foreach (\Storage::json('public/json/' . $menu['file'])['sousmenus'] as $sousmenu)
                <li class="p-2 flex flex-row gap-2">
                    <x-forms.input-classic label="" :field="$sousmenu['url']" :value="$sousmenu['intitule']" class="w-full"></x-forms.input-classic>
                    <x-forms.input-classic label="" :field="'ordre'" :value="$i" class="w-10"></x-forms.input-classic>
                </li>
                @php
                    $i++
                @endphp
                @endforeach
            </ul>

            @endforeach
        </div>
    </div>
</x-app-layout>
