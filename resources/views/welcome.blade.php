<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prosa · Interação social para a melhor idade</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-prosa-creme font-sans antialiased">

    {{-- Topo --}}
    <header class="bg-prosa-verde">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-3">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo-prosa.png') }}" alt="Prosa" class="h-20">
            </a>
            <nav class="flex items-center gap-3 font-bold">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="rounded-full bg-prosa-amarelo px-5 py-2 text-white">Minha página</a>
                @else
                    <a href="{{ route('login') }}" class="text-prosa-destaque hover:underline">Entrar</a>
                    <a href="{{ route('register') }}"
                       class="rounded-full bg-prosa-amarelo px-5 py-2 text-white">Cadastre-se</a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- Apresentação --}}
    <section class="bg-prosa-claro">
        <div class="mx-auto max-w-4xl px-6 py-16 text-center">
            <h1 class="font-titulo text-4xl font-bold text-prosa-cinza md:text-5xl">Sinta-se à vontade</h1>
            <p class="mx-auto mt-5 max-w-2xl text-xl text-prosa-cinza">
                A Prosa surgiu com a intenção de criar relações novas. Aqui, você encontrará
                experiências e oportunidades de se conectar com pessoas diferentes.
            </p>
            @guest
                <a href="{{ route('register') }}"
                   class="mt-8 inline-block rounded-full bg-prosa-amarelo px-10 py-4 font-titulo text-2xl font-bold text-white shadow-md hover:brightness-95">
                    Quero participar
                </a>
            @endguest
        </div>
    </section>

    {{-- Números --}}
    <section class="mx-auto max-w-6xl px-6 py-12">
<div class="grid grid-cols-2 gap-5 md:grid-cols-4">
    @foreach ([
        ['Pessoas', $totais['usuarios'], 'usuarios.png'],
        ['Comunidades', $totais['comunidades'], 'comunidades.png'],
        ['Eventos', $totais['eventos'], 'eventos.png'],
        ['Interesses', $totais['interesses'], 'expectativa.png'],
    ] as [$rotulo, $valor, $icone])
        <div class="rounded-3xl bg-prosa-verde p-6 text-center shadow-lg">
            <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-prosa-creme">
                <img src="{{ asset('img/icones/'.$icone) }}" alt="" class="h-9 w-9">
            </span>
            <p class="mt-2 font-titulo text-4xl font-bold text-prosa-destaque">{{ $valor }}</p>
            <p class="font-bold text-prosa-destaque">{{ $rotulo }}</p>
        </div>
            @endforeach
        </div>
    </section>
{{-- Eventos --}}
<section class="mx-auto max-w-6xl px-6 pb-12">
    <h2 class="mb-6 font-titulo text-3xl font-bold text-prosa-cinza">Eventos</h2>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($eventos as $evento)
<article class="rounded-3xl border-l-8 border-prosa-amarelo bg-white p-6 shadow-md">
    <p class="inline-block rounded-full bg-prosa-amarelo px-3 py-1 text-sm font-bold uppercase text-white">
        {{ $evento->data_hora->format('d/m/Y · H:i') }}
    </p>
    <h3 class="mt-3 font-titulo text-xl font-bold text-prosa-cinza">{{ $evento->titulo }}</h3>

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

    <p class="mt-2 flex items-center gap-2 text-sm font-bold text-prosa-cinza">
        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-prosa-claro/40">
            <img src="{{ asset('img/icones/usuarios.png') }}" alt="" class="h-5 w-5">
        </span>
        {{ $evento->participantes_count }} confirmados
    </p>
</article>
        @empty
            <p class="text-prosa-cinza">Nenhum evento cadastrado ainda.</p>
        @endforelse
    </div>
</section>

{{-- Comunidades --}}
<section class="bg-white">
    <div class="mx-auto max-w-6xl px-6 py-12">
        <h2 class="mb-6 font-titulo text-3xl font-bold text-prosa-cinza">Comunidades</h2>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($comunidades as $comunidade)
<article class="rounded-3xl border-l-8 border-prosa-verde bg-prosa-creme p-6 shadow-sm">
    <h3 class="font-titulo text-xl font-bold text-prosa-cinza">{{ $comunidade->nome }}</h3>
    <p class="mt-2 text-prosa-cinza">{{ \Illuminate\Support\Str::limit($comunidade->descricao, 100) }}</p>
    <p class="mt-3 flex items-center gap-2 text-sm font-bold text-prosa-cinza">
        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-prosa-claro/40">
            <img src="{{ asset('img/icones/usuarios.png') }}" alt="" class="h-5 w-5">
        </span>
        {{ $comunidade->membros_count }} membros
    </p>
</article>
            @empty
                <p class="text-prosa-cinza">Nenhuma comunidade cadastrada ainda.</p>
            @endforelse
        </div>
    </div>
</section>

    {{-- Interesses --}}
    <section class="mx-auto max-w-6xl px-6 py-12">
        <h2 class="mb-6 font-titulo text-3xl font-bold text-prosa-cinza">Do que a gente gosta</h2>
        <div class="flex flex-wrap gap-3">
            @foreach ($interesses as $interesse)
                <span class="rounded-full border-2 border-prosa-verde px-6 py-2 text-lg font-bold text-prosa-verde">
                    {{ $interesse->nome }}
                    <span class="ml-1 text-sm text-stone-400">({{ $interesse->users_count }})</span>
                </span>
            @endforeach
        </div>
    </section>

    {{-- Pessoas --}}
    <section class="bg-prosa-claro">
        <div class="mx-auto max-w-6xl px-6 py-12">
            <h2 class="mb-6 font-titulo text-3xl font-bold text-prosa-cinza">Quem já está na Prosa</h2>
            <div class="grid grid-cols-2 gap-5 md:grid-cols-4">
                @foreach ($pessoas as $pessoa)
                    <div class="rounded-3xl bg-prosa-creme p-5 text-center shadow-sm">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-prosa-verde font-titulo text-3xl font-bold text-prosa-destaque">
                            {{ mb_substr($pessoa->name, 0, 1) }}
                        </div>
                        <p class="mt-3 font-bold text-prosa-cinza">{{ $pessoa->name }}</p>
                        <p class="text-sm text-prosa-cinza">{{ $pessoa->cidade }}</p>
                        <p class="text-sm text-prosa-cinza">{{ $pessoa->passatempo }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-prosa-verde py-6 text-center text-sm text-prosa-destaque">
        Prosa · Interação social para a melhor idade · © {{ date('Y') }}
    </footer>
</body>
</html>