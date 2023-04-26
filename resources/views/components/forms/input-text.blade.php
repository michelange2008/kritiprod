@props(['value', 'label', 'model'])

<div {{ $attributes->merge(['class' => 'flex flex-col my-2']) }}>

    <label>{{ $label}}</label>

    <input type="text" wire:model.defer="{{ $model }}"
        class="form-input rounded border-1 focus:active:border-0" 
        {{-- @isset($value) value="{{ $value }}" @endisset  --}}
        value="toto"
        >

    @error( $model )
        <div class="text-red-900 text-xs">{{ $message }}</div>
    @enderror

</div>

