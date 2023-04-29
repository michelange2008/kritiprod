<div>
    @if (session()->has('message'))
        <div class="my-3 p-3 h2 bg-green-400">{{ session('message') }}</div>
    @endif
</div>