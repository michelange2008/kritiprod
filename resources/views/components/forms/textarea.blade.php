<div class="flex flex-col my-2">

    <label for="{{ $id }}">{{ $name }}</label>

    <textarea id="{{ $id }}" wire:model.defer="{{ $model.".".$id }}" rows={{ $rows ?? 5}}
        class="form-input rounded border-1 focus:active:border-0"></textarea>

    @error($model.".".$id)
        <div class="text-red-900 text-xs">{{ $message }}</div>
    @enderror

</div>
