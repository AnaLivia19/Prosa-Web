<x-app-layout>
    <div class="mx-auto max-w-2xl">
        <h1 class="mb-6 font-titulo text-3xl font-bold text-prosa-cinza">Editar evento</h1>

        <form method="POST" action="{{ route('eventos.update', $evento) }}">
            @csrf
            @method('PUT')
            @include('eventos._form')

            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="prosa-btn !w-auto px-10">Atualizar</button>
                <a href="{{ route('eventos.show', $evento) }}" class="font-bold text-prosa-cinza underline">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>