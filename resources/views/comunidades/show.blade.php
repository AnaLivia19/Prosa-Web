<x-app-layout>
    @php
        $sou_membro = $comunidade->membros->contains(auth()->id());
        $podeEditar = auth()->id() === $comunidade->user_id || auth()->user()->is_admin;
    @endphp

    <div class="mx-auto max-w-3xl">
        <a href="{{ route('comunidades.index') }}" class="font-bold text-prosa-cinza underline">← Voltar para comunidades</a>

        <article class="mt-4 rounded-3xl bg-white p-8 shadow-md">
            <h1 class="font-titulo text-3xl font-bold text-prosa-cinza">{{ $comunidade->nome }}</h1>
            <p class="text-prosa-cinza">Criada por <strong>{{ $comunidade->criador->name }}</strong></p>

            <p class="mt-5 text-lg text-prosa-cinza">{{ $comunidade->descricao }}</p>

            <div class="mt-6 flex flex-wrap items-center gap-3">
                @if ($sou_membro)
                    <form method="POST" action="{{ route('comunidades.sair', $comunidade) }}">
                        @csrf @method('DELETE')
                        <button class="rounded-full border-2 border-prosa-verde px-6 py-2 font-bold text-prosa-verde">Sair da comunidade</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('comunidades.entrar', $comunidade) }}">
                        @csrf
                        <button class="rounded-full bg-prosa-verde px-6 py-2 font-bold text-prosa-destaque">Entrar na comunidade</button>
                    </form>
                @endif

                @if ($podeEditar)
                    <a href="{{ route('comunidades.edit', $comunidade) }}"
                       class="rounded-full bg-prosa-amarelo px-6 py-2 font-bold text-white">Editar</a>

                    <form method="POST" action="{{ route('comunidades.destroy', $comunidade) }}"
                          onsubmit="return confirm('Tem certeza que deseja excluir esta comunidade?')">
                        @csrf @method('DELETE')
                        <button class="rounded-full border-2 border-red-400 px-6 py-2 font-bold text-red-500">Excluir</button>
                    </form>
                @endif
            </div>
        </article>

        <section class="mt-8">
            <h2 class="mb-3 font-titulo text-xl font-bold text-prosa-cinza">
                Membros ({{ $comunidade->membros->count() }})
            </h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($comunidade->membros as $membro)
                    <span class="rounded-full bg-prosa-claro px-4 py-1 font-bold text-prosa-cinza">{{ $membro->name }}</span>
                @endforeach
            </div>
        </section>

        <section class="mt-8">
            <h2 class="mb-3 font-titulo text-xl font-bold text-prosa-cinza">Eventos da comunidade</h2>
            <ul class="space-y-2">
                @forelse ($comunidade->eventos->sortBy('data_hora') as $evento)
                    <li>
                        <a href="{{ route('eventos.show', $evento) }}"
                           class="block rounded-2xl bg-white px-4 py-3 text-prosa-cinza shadow-sm hover:shadow-md">
                            <p class="font-bold">{{ $evento->titulo }}</p>
                            <p class="text-sm">{{ $evento->data_hora->format('d/m H:i') }} · {{ $evento->local }}</p>
                        </a>
                    </li>
                @empty
                    <li class="text-prosa-cinza">Essa comunidade ainda não tem eventos.</li>
                @endforelse
            </ul>
        </section>
    </div>
</x-app-layout>