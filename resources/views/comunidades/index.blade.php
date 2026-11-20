<x-app-layout>
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <h1 class="font-titulo text-3xl font-bold text-prosa-cinza">Comunidades</h1>
        <a href="{{ route('comunidades.create') }}"
           class="rounded-full bg-prosa-amarelo px-6 py-3 font-titulo text-lg font-bold text-white shadow-md hover:brightness-95">
            + Nova comunidade
        </a>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($comunidades as $comunidade)
            <article class="flex flex-col rounded-3xl bg-white p-6 shadow-md">
                <h2 class="font-titulo text-xl font-bold text-prosa-cinza">{{ $comunidade->nome }}</h2>
                <p class="text-sm text-prosa-cinza">Criada por {{ $comunidade->criador->name }}</p>
                <p class="mt-3 flex-1 text-prosa-cinza">
                    {{ \Illuminate\Support\Str::limit($comunidade->descricao, 90) }}
                </p>

<div class="mt-4 flex items-center justify-between">
    <span class="flex items-center gap-2 text-sm font-bold text-prosa-cinza">
        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-prosa-claro/40">
            <img src="{{ asset('img/icones/usuarios.png') }}" alt="" class="h-5 w-5">
        </span>
        {{ $comunidade->membros_count }} membros
    </span>
    <a href="{{ route('comunidades.show', $comunidade) }}"
       class="rounded-full bg-prosa-verde px-5 py-2 font-bold text-prosa-destaque">Ver</a>
</div>
            </article>
        @empty
            <p class="text-prosa-cinza">Nenhuma comunidade cadastrada ainda.</p>
        @endforelse
    </div>

    <div class="mt-8">{{ $comunidades->links() }}</div>
</x-app-layout>