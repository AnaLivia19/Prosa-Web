<x-app-layout>
    <div class="mx-auto max-w-xl">
        <h1 class="mb-6 font-titulo text-3xl font-bold text-prosa-cinza">Editar interesse</h1>

        <form method="POST" action="{{ route('admin.interesses.update', $interesse) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <input type="text" name="nome" value="{{ old('nome', $interesse->nome) }}" required class="prosa-input">
                <x-input-error :messages="$errors->get('nome')" class="ml-4 mt-1" />
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="prosa-btn !w-auto px-10">Atualizar</button>
                <a href="{{ route('admin.interesses.index') }}" class="font-bold text-prosa-cinza underline">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>