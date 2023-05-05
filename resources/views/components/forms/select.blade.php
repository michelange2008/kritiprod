@props(['label', 'field', 'options'])

<div {{ $attributes->merge([ 'class' => "flex flex-col my-2"]) }}>

    <label>{{ $label }}</label>

    <select wire:model.defer="{{ 'state.'.$field }}">

        <option hidden value="">Choisir une valeur dans la liste ...</option>

        @foreach ($options as $id => $option)

        <option value="{{ $id }}">{{ ucFirst($option) }} </option>

        @endforeach

    </select>

</div>

