<x-guest-layout>
    <h1 class="mb-8 text-center font-titulo text-4xl font-bold text-prosa-cinza">Bem-Vindo!</h1>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="E-mail..."
                   required autofocus class="prosa-input">
            <x-input-error :messages="$errors->get('email')" class="mt-1 ml-4" />
        </div>

        <div>
            <input type="password" name="password" placeholder="Senha..." required class="prosa-input">
            <x-input-error :messages="$errors->get('password')" class="mt-1 ml-4" />
        </div>

        <button type="submit" class="prosa-btn">Entrar</button>

        <div class="space-y-2 text-center text-sm font-bold text-prosa-cinza">
            <a href="{{ route('password.request') }}" class="block underline">Esqueci minha senha</a>
            <a href="{{ route('register') }}" class="block">Não tem uma conta? Cadastre-se...</a>
        </div>
    </form>
</x-guest-layout>