@props(['disabled' => false, 'type' => 'text', 'name' => 'name', 'label' => 'intitulé du champ', 'value' => ''])

<div {{ $attributes->merge(['class' => 'my-2 flex flex-col gap-1']) }}>

    <label for="{{ $name }}">{{ $label }}</label>

    <input class="inline-block disabled:text-gray-500" type="{{ $type }}" name="{{ $name }}"
        value="{{ $value }}" @if ($disabled) disabled @endif>

    {{-- @error($model)
        <div class="text-red-900 text-xs">{{ $message }}</div>
    @enderror --}}

</div>
