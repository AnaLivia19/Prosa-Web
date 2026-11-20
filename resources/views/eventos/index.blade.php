<x-app-layout>
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <h1 class="font-titulo text-3xl font-bold text-prosa-cinza">Eventos</h1>
        <a href="{{ route('eventos.create') }}"
           class="rounded-full bg-prosa-amarelo px-6 py-3 font-titulo text-lg font-bold text-white shadow-md hover:brightness-95">
            + Novo evento
        </a>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($eventos as $evento)
<article class="flex flex-col rounded-3xl border-l-8 border-prosa-amarelo bg-white p-6 shadow-md">
    <p class="inline-block self-start rounded-full bg-prosa-amarelo px-3 py-1 text-sm font-bold uppercase text-white">
        {{ $evento->data_hora->format('d/m/Y · H:i') }}
    </p>
    <h2 class="mt-3 font-titulo text-xl font-bold text-prosa-cinza">{{ $evento->titulo }}</h2>

    <p class="mt-3 flex items-center gap-2 text-prosa-cinza">
        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-prosa-claro/40">
            <img src="{{ asset('img/icones/mapa.png') }}" alt="" class="h-5 w-5">
        </span>
        {{ $evento->local }}
    </p>

    @if ($evento->comunidade)
        <p class="mt-2 flex items-center gap-2 text-sm text-prosa-cinza">
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-prosa-claro/40">
                <img src="{{ asset('img/icones/comunidades.png') }}" alt="" class="h-5 w-5">
            </span>
            {{ $evento->comunidade->nome }}
        </p>
    @endif

    <p class="mt-3 flex-1 text-prosa-cinza">{{ \Illuminate\Support\Str::limit($evento->descricao, 90) }}</p>

    <div class="mt-4 flex items-center justify-between">
        <span class="flex items-center gap-2 text-sm font-bold text-prosa-cinza">
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-prosa-claro/40">
                <img src="{{ asset('img/icones/usuarios.png') }}" alt="" class="h-5 w-5">
            </span>
            {{ $evento->participantes_count }} confirmados
        </span>
        <a href="{{ route('eventos.show', $evento) }}"
           class="rounded-full bg-prosa-verde px-5 py-2 font-bold text-prosa-destaque">Ver</a>
    </div>
</article>
        @empty
            <p class="text-prosa-cinza">Nenhum evento cadastrado ainda.</p>
        @endforelse
    </div>

    <div class="mt-8">{{ $eventos->links() }}</div>
</x-app-layout>