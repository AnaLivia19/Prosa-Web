@php $comunidade = $comunidade ?? null; @endphp

<div class="space-y-5">
    <div>
        <label class="mb-1 ml-4 block font-bold text-prosa-cinza">Nome</label>
        <input type="text" name="nome" value="{{ old('nome', $comunidade?->nome) }}" required class="prosa-input">
        <x-input-error :messages="$errors->get('nome')" class="ml-4 mt-1" />
    </div>

    <div>
        <label class="mb-1 ml-4 block font-bold text-prosa-cinza">Descrição</label>
        <textarea name="descricao" rows="5" class="prosa-input !rounded-3xl">{{ old('descricao', $comunidade?->descricao) }}</textarea>
        <x-input-error :messages="$errors->get('descricao')" class="ml-4 mt-1" />
    </div>
</div>