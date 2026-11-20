<x-app-layout>
    @php
        $idade = $user->data_nascimento ? \Carbon\Carbon::parse($user->data_nascimento)->age : null;
        $botoes = [
    ['Explorar', 'mapa.png', route('explorar')],
    ['Amigos', 'amigos.png', route('amigos.index')],
    ['Comunidades', 'comunidades.png', route('comunidades.index')],
    ['Eventos', 'eventos.png', route('eventos.index')],
];
    @endphp

    <div class="grid gap-8 lg:grid-cols-3">

        {{-- Coluna esquerda: perfil --}}
        <aside class="h-fit rounded-3xl bg-prosa-claro p-6 text-center shadow-md">
            @if ($user->foto)
                <img src="{{ asset('storage/'.$user->foto) }}" alt="Foto de {{ $user->name }}"
                     class="mx-auto h-36 w-36 rounded-3xl border-4 border-stone-200 object-cover">
            @else
                <div class="mx-auto flex h-36 w-36 items-center justify-center rounded-3xl border-4 border-stone-200 bg-prosa-creme font-titulo text-6xl font-bold text-prosa-verde">
                    {{ mb_substr($user->name, 0, 1) }}
                </div>
            @endif

            <h1 class="mt-4 font-titulo text-3xl font-bold text-prosa-cinza">{{ $user->name }}</h1>

            <ul class="mt-4 space-y-2 text-left font-bold text-prosa-cinza">
                <li class="rounded-full bg-prosa-creme px-4 py-1">• {{ $user->cidade }}</li>
                <li class="rounded-full bg-prosa-creme px-4 py-1">• {{ $idade ? $idade.' anos' : '' }}</li>
                <li class="rounded-full bg-prosa-creme px-4 py-1">• {{ $user->passatempo }}</li>
                <li class="rounded-full bg-prosa-creme px-4 py-1">• {{ $user->profissao }}</li>
            </ul>

            <a href="{{ route('profile.edit') }}"
               class="mt-5 inline-block rounded-full bg-prosa-verde px-6 py-2 font-bold text-prosa-destaque">
                Editar perfil
            </a>
        </aside>

        {{-- Coluna direita: conteúdo --}}
        <div class="space-y-8 lg:col-span-2">

            <section>
                <h2 class="font-titulo text-2xl font-bold text-prosa-cinza">Sobre você</h2>
                <p class="mt-3 border-l-2 border-stone-300 pl-4 text-lg font-bold leading-snug text-prosa-cinza">
                    {{ $user->sobre }}
                </p>

                <div class="mt-5 flex flex-wrap gap-3">
                    @foreach ($user->interesses as $interesse)
                        <span class="rounded-full border-2 border-stone-300 px-6 py-1 text-lg font-bold text-stone-400">
                            {{ $interesse->nome }}
                        </span>
                    @endforeach
                </div>
            </section>

            <nav class="grid grid-cols-2 gap-5 md:grid-cols-4">
                @foreach ($botoes as [$nome, $icone, $link])
                    <a href="{{ $link }}"
                       class="flex h-32 flex-col items-center justify-center gap-2 rounded-3xl bg-prosa-verde shadow-lg transition hover:-translate-y-1">
                    <span class="flex h-14 w-14 items-center justify-center rounded-full bg-prosa-creme">
                    <img src="{{ asset('img/icones/'.$icone) }}" alt="" class="h-9 w-9">
                    </span>
                    <span class="font-bold text-prosa-destaque">{{ $nome }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="grid gap-8 md:grid-cols-2">
                <section>
                    <h2 class="mb-3 font-titulo text-xl font-bold text-prosa-cinza">Minhas comunidades</h2>
                    <ul class="space-y-2">
                        @forelse ($user->comunidades->take(4) as $comunidade)
                            <li class="rounded-2xl bg-white px-4 py-3 font-bold text-prosa-cinza shadow-sm">
                                {{ $comunidade->nome }}
                            </li>
                        @empty
                            <li class="text-prosa-cinza">Você ainda não participa de nenhuma comunidade.</li>
                        @endforelse
                    </ul>
                </section>

                <section>
                    <h2 class="mb-3 font-titulo text-xl font-bold text-prosa-cinza">Próximos eventos</h2>
                    <ul class="space-y-2">
                        @forelse ($user->eventos->sortBy('data_hora')->take(4) as $evento)
                            <li class="rounded-2xl bg-white px-4 py-3 text-prosa-cinza shadow-sm">
                                <p class="font-bold">{{ $evento->titulo }}</p>
                                <p class="text-sm">{{ $evento->data_hora->format('d/m H:i') }} · {{ $evento->local }}</p>
                            </li>
                        @empty
                            <li class="text-prosa-cinza">Nenhum evento marcado.</li>
                        @endforelse
                    </ul>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>