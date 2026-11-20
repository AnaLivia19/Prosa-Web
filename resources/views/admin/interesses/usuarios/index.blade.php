<x-app-layout>
    <h1 class="mb-6 font-titulo text-3xl font-bold text-prosa-cinza">Admin · Usuários</h1>

    <div class="overflow-x-auto rounded-3xl bg-white shadow-md">
        <table class="w-full text-left text-prosa-cinza">
            <thead class="bg-prosa-claro font-bold">
                <tr>
                    <th class="px-5 py-3">Nome</th>
                    <th class="px-5 py-3">E-mail</th>
                    <th class="px-5 py-3">Cidade</th>
                    <th class="px-5 py-3">Comunidades</th>
                    <th class="px-5 py-3">Eventos</th>
                    <th class="px-5 py-3">Perfil</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $u)
                    <tr class="border-t border-stone-200">
                        <td class="px-5 py-3 font-bold">{{ $u->name }}</td>
                        <td class="px-5 py-3">{{ $u->email }}</td>
                        <td class="px-5 py-3">{{ $u->cidade }}</td>
                        <td class="px-5 py-3">{{ $u->comunidades_count }}</td>
                        <td class="px-5 py-3">{{ $u->eventos_count }}</td>
                        <td class="px-5 py-3">{{ $u->is_admin ? 'Admin' : 'Usuário' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $usuarios->links() }}</div>
</x-app-layout>