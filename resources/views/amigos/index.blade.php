<x-app-layout>
    <h1 class="mb-6 font-titulo text-3xl font-bold text-prosa-cinza">Amigos</h1>

    {{-- Pedidos recebidos --}}
    <section class="mb-10">
        <h2 class="mb-3 font-titulo text-xl font-bold text-prosa-cinza">Pedidos recebidos ({{ $recebidos->count() }})</h2>
        <ul class="space-y-2">
            @forelse ($recebidos as $a)
                <li class="flex flex-wrap items-center justify-between gap-3 rounded-2xl bg-white px-5 py-3 shadow-sm">
                    <span class="font-bold text-prosa-cinza">{{ $a->remetente->name }}
                        <span class="font-normal">· {{ $a->remetente->cidade }}</span></span>
                    <span class="flex gap-2">
                        <form method="POST" action="{{ route('amigos.aceitar', $a) }}">
                            @csrf @method('PATCH')
                            <button class="rounded-full bg-prosa-verde px-5 py-1 font-bold text-prosa-destaque">Aceitar</button>
                        </form>
                        <form method="POST" action="{{ route('amigos.destroy', $a) }}">
                            @csrf @method('DELETE')
                            <button class="rounded-full border-2 border-red-400 px-5 py-1 font-bold text-red-500">Recusar</button>
                        </form>
                    </span>
                </li>
            @empty
                <li class="text-prosa-cinza">Nenhum pedido pendente.</li>
            @endforelse
        </ul>
    </section>

    {{-- Meus amigos --}}
    <section class="mb-10">
        <h2 class="mb-3 font-titulo text-xl font-bold text-prosa-cinza">Meus amigos ({{ $amigos->count() }})</h2>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($amigos as $a)
                @php $outro = $a->user_id === auth()->id() ? $a->destinatario : $a->remetente; @endphp
                <div class="flex items-center justify-between gap-3 rounded-2xl bg-white px-5 py-4 shadow-sm">
                    <div>
                        <p class="font-bold text-prosa-cinza">{{ $outro->name }}</p>
                        <p class="text-sm text-prosa-cinza">{{ $outro->cidade }} · {{ $outro->passatempo }}</p>
                    </div>
                    <form method="POST" action="{{ route('amigos.destroy', $a) }}"
                          onsubmit="return confirm('Desfazer a amizade com {{ $outro->name }}?')">
                        @csrf @method('DELETE')
                        <button class="text-sm font-bold text-red-500 underline">Desfazer</button>
                    </form>
                </div>
            @empty
                <p class="text-prosa-cinza">
                    Você ainda não tem amigos. <a href="{{ route('explorar') }}" class="font-bold underline">Explore</a> e conheça gente nova!
                </p>
            @endforelse
        </div>
    </section>

    {{-- Pedidos enviados --}}
    <section>
        <h2 class="mb-3 font-titulo text-xl font-bold text-prosa-cinza">Pedidos enviados ({{ $enviados->count() }})</h2>
        <ul class="space-y-2">
            @forelse ($enviados as $a)
                <li class="flex flex-wrap items-center justify-between gap-3 rounded-2xl bg-white px-5 py-3 shadow-sm">
                    <span class="font-bold text-prosa-cinza">{{ $a->destinatario->name }}</span>
                    <form method="POST" action="{{ route('amigos.destroy', $a) }}">
                        @csrf @method('DELETE')
                        <button class="text-sm font-bold text-prosa-cinza underline">Cancelar pedido</button>
                    </form>
                </li>
            @empty
                <li class="text-prosa-cinza">Nenhum pedido aguardando resposta.</li>
            @endforelse
        </ul>
    </section>
</x-app-layout>