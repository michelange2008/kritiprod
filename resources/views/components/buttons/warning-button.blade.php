<button {{ $attributes->merge([
        'class' => " btn bg-amber-800 hover:bg-amber-600 focus:ring-amber-600 active:bg-amber-900  active:ring-amber-900",
        'type' => "button"
])}}>

    {{ $slot }}

</button>
