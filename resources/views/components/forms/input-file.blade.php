<div class="flex flex-col my-2">

    <label>{{ $name }}</label>

    <input type="file" wire:model.defer="{{ $model }}" class="form-input rounded border-1 focus:active:border-0">
    @error($model)
        <div class="text-red-900 text-xs">{{ $message }}</div>
    @enderror
    
</div>