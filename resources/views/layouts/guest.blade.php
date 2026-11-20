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
<body class="font-sans antialiased">
    <div class="min-h-screen lg:grid lg:grid-cols-2">
        <div class="flex flex-col items-center justify-center bg-prosa-verde px-6 py-10 text-center">
            <a href="/"><img src="{{ asset('img/logo-prosa.png') }}" alt="Prosa" class="h-32 lg:h-56"></a>
            <p class="mt-6 hidden max-w-sm font-titulo text-2xl text-prosa-destaque lg:block">
                Conversa boa, amizade nova.
            </p>
        </div>

        <main class="flex items-center justify-center bg-prosa-creme px-6 py-10">
            <div class="w-full max-w-md">{{ $slot }}</div>
        </main>
    </div>
</body>
</html>