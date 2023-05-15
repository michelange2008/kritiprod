<div class="my-2 flex flex-col gap-1">

    <label for="{{ $name }}">{{ $label }}</label>

    <select name="{{ $name }}" id="{{ $name }}">
        
        @foreach ($options as $option => $intitule)

            <option @if ($option == $selected) selected @endif

                value="{{ $option }}">

                {{ $intitule }}

            </option>

        @endforeach

    </select>

</div>
