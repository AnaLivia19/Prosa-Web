<x-guest-layout>
    <h1 class="mb-8 text-center font-titulo text-4xl font-bold text-prosa-cinza">Bem-Vindo!</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Seu nome..."
                   required autofocus class="prosa-input">
            <x-input-error :messages="$errors->get('name')" class="mt-1 ml-4" />
        </div>

        <div>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="E-mail..."
                   required class="prosa-input">
            <x-input-error :messages="$errors->get('email')" class="mt-1 ml-4" />
        </div>

        <div>
            <input type="password" name="password" placeholder="Senha..." required class="prosa-input">
            <x-input-error :messages="$errors->get('password')" class="mt-1 ml-4" />
        </div>

        <div>
            <input type="password" name="password_confirmation" placeholder="Confirme a senha..."
                   required class="prosa-input">
        </div>

        <div>
            <input type="text" name="data_nascimento" value="{{ old('data_nascimento') }}"
                   placeholder="Data de Nascimento..." onfocus="this.type='date'" required class="prosa-input">
            <x-input-error :messages="$errors->get('data_nascimento')" class="mt-1 ml-4" />
        </div>

        <button type="submit" class="prosa-btn">Cadastrar</button>

        <p class="text-center text-sm font-bold text-prosa-cinza">
            <a href="{{ route('login') }}">Já tem uma conta? Entre...</a>
        </p>
    </form>
</x-guest-layout>