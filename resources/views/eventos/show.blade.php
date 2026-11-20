<x-app-layout>
    @php
        $participo = $evento->participantes->contains(auth()->id());
        $podeEditar = auth()->id() === $evento->user_id || auth()->user()->is_admin;
    @endphp

    <div class="mx-auto max-w-3xl">
        <a href="{{ route('eventos.index') }}" class="font-bold text-prosa-cinza underline">← Voltar para eventos</a>

        <article class="mt-4 rounded-3xl bg-white p-8 shadow-md">
            <p class="font-bold uppercase text-prosa-claro">{{ $evento->data_hora->format('d/m/Y · H:i') }}</p>
            <h1 class="mt-1 font-titulo text-3xl font-bold text-prosa-cinza">{{ $evento->titulo }}</h1>
            <p class="mt-2 text-lg text-prosa-cinza">📍 {{ $evento->local }}</p>
            @if ($evento->comunidade)
                <p class="text-prosa-cinza">💬 {{ $evento->comunidade->nome }}</p>
            @endif
            <p class="text-prosa-cinza">Organizado por <strong>{{ $evento->organizador->name }}</strong></p>

            <p class="mt-5 text-lg text-prosa-cinza">{{ $evento->descricao }}</p>

            <div class="mt-6 flex flex-wrap items-center gap-3">
                @if ($participo)
                    <form method="POST" action="{{ route('eventos.sair', $evento) }}">
                        @csrf @method('DELETE')
                        <button class="rounded-full border-2 border-prosa-verde px-6 py-2 font-bold text-prosa-verde">Sair do evento</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('eventos.participar', $evento) }}">
                        @csrf
                        <button class="rounded-full bg-prosa-verde px-6 py-2 font-bold text-prosa-destaque">Quero participar</button>
                    </form>
                @endif

                @if ($podeEditar)
                    <a href="{{ route('eventos.edit', $evento) }}"
                       class="rounded-full bg-prosa-amarelo px-6 py-2 font-bold text-white">Editar</a>

                    <form method="POST" action="{{ route('eventos.destroy', $evento) }}"
                          onsubmit="return confirm('Tem certeza que deseja excluir este evento?')">
                        @csrf @method('DELETE')
                        <button class="rounded-full border-2 border-red-400 px-6 py-2 font-bold text-red-500">Excluir</button>
                    </form>
                @endif
            </div>
        </article>

        <section class="mt-8">
            <h2 class="mb-3 font-titulo text-xl font-bold text-prosa-cinza">
                Quem vai ({{ $evento->participantes->count() }})
            </h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($evento->participantes as $p)
                    <span class="rounded-full bg-prosa-claro px-4 py-1 font-bold text-prosa-cinza">{{ $p->name }}</span>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>