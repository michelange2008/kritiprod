@props(['value', 'id', 'name', 'model'])

<div {{ $attributes->merge(['class' => 'flex flex-col my-2']) }}>

    <label for="{{$id}}">{{ $name}}</label>

    <input id="{{ $id }}" type="text" wire:model.defer="{{ $model.".".$id }}"
        class="form-input rounded border-1 focus:active:border-0" 
        {{-- @isset($value) value="{{ $value }}" @endisset  --}}
        value="toto"
        >

    @error( $model.".".$id )
        <div class="text-red-900 text-xs">{{ $message }}</div>
    @enderror

</div>

