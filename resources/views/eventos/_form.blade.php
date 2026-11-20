@php $evento = $evento ?? null; @endphp

<div class="space-y-5">
    <div>
        <label class="mb-1 ml-4 block font-bold text-prosa-cinza">Título</label>
        <input type="text" name="titulo" value="{{ old('titulo', $evento?->titulo) }}" required class="prosa-input">
        <x-input-error :messages="$errors->get('titulo')" class="ml-4 mt-1" />
    </div>

    <div>
        <label class="mb-1 ml-4 block font-bold text-prosa-cinza">Descrição</label>
        <textarea name="descricao" rows="4" class="prosa-input !rounded-3xl">{{ old('descricao', $evento?->descricao) }}</textarea>
        <x-input-error :messages="$errors->get('descricao')" class="ml-4 mt-1" />
    </div>

    <div>
        <label class="mb-1 ml-4 block font-bold text-prosa-cinza">Local</label>
        <input type="text" name="local" value="{{ old('local', $evento?->local) }}" required class="prosa-input">
        <x-input-error :messages="$errors->get('local')" class="ml-4 mt-1" />
    </div>

    <div>
        <label class="mb-1 ml-4 block font-bold text-prosa-cinza">Data e hora</label>
        <input type="datetime-local" name="data_hora"
               value="{{ old('data_hora', $evento?->data_hora?->format('Y-m-d\TH:i')) }}" required class="prosa-input">
        <x-input-error :messages="$errors->get('data_hora')" class="ml-4 mt-1" />
    </div>

    <div>
        <label class="mb-1 ml-4 block font-bold text-prosa-cinza">Comunidade (opcional)</label>
        <select name="comunidade_id" class="prosa-input">
            <option value="">Sem comunidade</option>
            @foreach ($comunidades as $comunidade)
                <option value="{{ $comunidade->id }}"
                    @selected(old('comunidade_id', $evento?->comunidade_id) == $comunidade->id)>
                    {{ $comunidade->nome }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('comunidade_id')" class="ml-4 mt-1" />
    </div>
</div>