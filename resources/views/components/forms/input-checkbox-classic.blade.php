<div class="my-3">
    <input id="{{ $name }}" class="rounded text-teal-800" name="{{ $name }}" type="checkbox"
        @if ($checked) checked @endif>
    <label for="{{ $name }}">{{ $label }}</label>
</div>
