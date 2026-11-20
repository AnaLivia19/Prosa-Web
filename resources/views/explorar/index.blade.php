<x-app-layout>
    <h1 class="font-titulo text-3xl font-bold text-prosa-cinza">Explorar</h1>
    <p class="mt-1 text-lg text-prosa-cinza">Quem tem interesses parecidos com os seus aparece primeiro.</p>

    <form method="GET" action="{{ route('explorar') }}" class="my-6 flex flex-wrap gap-3">
        <input type="text" name="busca" value="{{ request('busca') }}"
               placeholder="Buscar por nome ou cidade..." class="prosa-input max-w-md">
        <button class="rounded-full bg-prosa-verde px-8 py-4 font-bold text-prosa-destaque">Buscar</button>
    </form>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($usuarios as $u)
            @php $rel = $relacoes->get($u->id); @endphp
            <article class="flex flex-col rounded-3xl bg-white p-6 text-center shadow-md">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-prosa-verde font-titulo text-3xl font-bold text-prosa-destaque">
                    {{ mb_substr($u->name, 0, 1) }}
                </div>
                <h2 class="mt-3 font-titulo text-xl font-bold text-prosa-cinza">{{ $u->name }}</h2>
                <p class="text-prosa-cinza">{{ $u->cidade }} · {{ $u->passatempo }}</p>

                <div class="mt-3 flex flex-wrap justify-center gap-2">
                    @foreach ($u->interesses->take(3) as $interesse)
                        <span class="rounded-full border-2 border-stone-300 px-3 py-0.5 text-sm font-bold text-stone-400">
                            {{ $interesse->nome }}
                        </span>
                    @endforeach
                </div>

                @if ($u->em_comum > 0)
                    <p class="mt-3 text-sm font-bold text-prosa-claro">⭐ {{ $u->em_comum }} em comum com você</p>
                @endif

                <div class="mt-auto pt-4">
                    @if (! $rel)
                        <form method="POST" action="{{ route('amigos.solicitar', $u) }}">
                            @csrf
                            <button class="rounded-full bg-prosa-amarelo px-6 py-2 font-bold text-white">+ Adicionar</button>
                        </form>
                    @elseif ($rel->status === 'aceita')
                        <span class="font-bold text-prosa-verde">✓ Vocês são amigos</span>
                    @elseif ($rel->user_id === auth()->id())
                        <span class="font-bold text-stone-400">Pedido enviado</span>
                    @else
                        <a href="{{ route('amigos.index') }}" class="font-bold text-prosa-verde underline">Responder pedido</a>
                    @endif
                </div>
            </article>
        @empty
            <p class="text-prosa-cinza">Ninguém encontrado com essa busca.</p>
        @endforelse
    </div>

    <div class="mt-8">{{ $usuarios->links() }}</div>
</x-app-layout>