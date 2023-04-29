@props(['label', 'field'])

<div {{ $attributes->merge(['class' => 'flex flex-col my-2']) }}>

    <label>{{ $label}}</label>

    <input type="text" wire:model.defer="{{ 'state.'.$field }}"
        class="form-input rounded border-1 focus:active:border-0" 
        >

    @error( $field )
        <div class="text-red-900 text-xs">{{ $message }}</div>
    @enderror

</div>

