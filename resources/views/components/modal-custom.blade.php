@props([
    'name',
    'show' => false,
])

<div 
    x-data="{
        show: @js($show),

    }"
    x-show="show"
    x-cloak 
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = !show : null"
    x-trap.inert.noscroll="show" 
    x-on:close.stop="show = false"

    @keydown.escape="show = false"
    x-transition:enter="ease-out duration-100"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-0 inset-0 z-40 bg-gray-400/50 py-5">

    <div 
        x-show='show' 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="w-full sm:w-3/4 lg:w-2/3 xl-w-1/2 m-auto shadow transition-all">

        {{ $slot }}

    </div>

</div>
