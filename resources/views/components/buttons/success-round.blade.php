<button {{ $attributes->merge([
    'class' => 'fixed z-50 shadow-xl right-3 bottom-3 w-14 h-14 rounded-full 
        flex items-center justify-center p-3
        bg-teal-900 hover:bg-teal-600']) }} >
    <img class="hover:invert" src="{{ url('storage/img/icones/add.svg') }}" alt="add">
</button>
