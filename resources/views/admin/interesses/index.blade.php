<x-app-layout>
    <h1 class="mb-6 font-titulo text-3xl font-bold text-prosa-cinza">Admin · Interesses</h1>

    <form method="POST" action="{{ route('admin.interesses.store') }}" class="mb-8 flex flex-wrap items-start gap-3">
        @csrf
        <div class="w-full max-w-sm">
            <input type="text" name="nome" value="{{ old('nome') }}" placeholder="Novo interesse..." required class="prosa-input">
            <x-input-error :messages="$errors->get('nome')" class="ml-4 mt-1" />
        </div>
        <button class="rounded-full bg-prosa-amarelo px-8 py-4 font-titulo text-lg font-bold text-white shadow-md">Adicionar</button>
    </form>

    <div class="overflow-x-auto rounded-3xl bg-white shadow-md">
        <table class="w-full text-left text-prosa-cinza">
            <thead class="bg-prosa-claro font-bold">
                <tr>
                    <th class="px-5 py-3">Nome</th>
                    <th class="px-5 py-3">Usuários</th>
                    <th class="px-5 py-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($interesses as $interesse)
                    <tr class="border-t border-stone-200">
                        <td class="px-5 py-3 font-bold">{{ $interesse->nome }}</td>
                        <td class="px-5 py-3">{{ $interesse->users_count }}</td>
                        <td class="flex gap-3 px-5 py-3">
                            <a href="{{ route('admin.interesses.edit', $interesse) }}"
                               class="rounded-full bg-prosa-amarelo px-4 py-1 font-bold text-white">Editar</a>
                            <form method="POST" action="{{ route('admin.interesses.destroy', $interesse) }}"
                                  onsubmit="return confirm('Excluir este interesse?')">
                                @csrf @method('DELETE')
                                <button class="rounded-full border-2 border-red-400 px-4 py-1 font-bold text-red-500">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>