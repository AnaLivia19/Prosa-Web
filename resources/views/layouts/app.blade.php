<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prosa</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-prosa-creme font-sans antialiased">
    @php
$links = [
    ['Início', route('dashboard')],
    ['Explorar', route('explorar')],
    ['Amigos', route('amigos.index')],
    ['Comunidades', route('comunidades.index')],
    ['Eventos', route('eventos.index')],
    ['Meu perfil', route('profile.edit')],
];

if (auth()->user()->is_admin) {
    $links[] = ['Admin', route('admin.interesses.index')];
}
    @endphp

    <div class="flex min-h-screen flex-col">
        <header x-data="{ aberto: false }" class="bg-prosa-verde">
            <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-3">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('img/logo-prosa.png') }}" alt="Prosa" class="h-14">
                </a>

                <nav class="hidden items-center gap-6 font-bold text-prosa-destaque md:flex">
                    @foreach ($links as [$nome, $url])
                        <a href="{{ $url }}" class="hover:underline">{{ $nome }}</a>
                    @endforeach
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-full border-2 border-prosa-destaque px-4 py-1 hover:bg-prosa-destaque hover:text-prosa-verde">Sair</button>
                    </form>
                </nav>

                <button @click="aberto = !aberto" aria-label="Menu"
                        class="text-3xl text-prosa-destaque md:hidden">☰</button>
            </div>

            <nav x-show="aberto" x-cloak class="flex flex-col gap-3 px-6 pb-4 font-bold text-prosa-destaque md:hidden">
                @foreach ($links as [$nome, $url])
                    <a href="{{ $url }}">{{ $nome }}</a>
                @endforeach
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="underline">Sair</button>
                </form>
            </nav>
        </header>

        <main class="mx-auto w-full max-w-6xl flex-1 px-6 py-8">
            @if (session('sucesso'))
    <div class="mb-6 rounded-2xl bg-prosa-claro px-5 py-3 font-bold text-prosa-cinza">
        {{ session('sucesso') }}
    </div>
@endif
            {{ $slot }}
        </main>

        <footer class="bg-prosa-verde py-6 text-center text-sm text-prosa-destaque">
            Prosa · Interação social para a melhor idade · © {{ date('Y') }}
        </footer>
    </div>
</body>
</html>