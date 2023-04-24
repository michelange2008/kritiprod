<button
    {{ $attributes->merge([
        'class' => ' btn bg-teal-800 hover:bg-teal-600 focus:ring-teal-600 active:bg-teal-900  active:ring-teal-900',
        'type' => 'submit',
    ]) }}>
    {{ $slot }}
</button>
