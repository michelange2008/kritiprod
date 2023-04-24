<div {{ $attributes->merge([ 'class' => 'titre-1 bg-amber-700']) }}>

    @isset($icone)
        <img class="w-8 p-1" src="{{ url('storage/img/icones/' . $icone) }}" alt="icone">
    @endisset

    <h2 class="text-gray-100">{{ ucfirst($slot) }}</h2>

</div>
