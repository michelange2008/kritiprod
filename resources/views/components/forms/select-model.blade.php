<div class="flex flex-col my-2">

    <label>{{ $label }}</label>

    <select wire:model.defer="{{ 'state.'.$model }}" wire:change="select()" multiple size="{{ $size ?? 5 }}">

        <option hidden value="">Choisir une valeur dans la liste ...</option>

        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ ucFirst($option->nom) }} </option>
        @endforeach

    </select>

</div>