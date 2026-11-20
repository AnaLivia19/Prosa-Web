<x-guest-layout>
    <form method="POST" action="{{ route('onboarding.store') }}"
          x-data="{ passo: {{ $errors->any() ? 2 : 1 }} }">
        @csrf

        {{-- Passo 1: boas-vindas --}}
        <div x-show="passo === 1" class="space-y-6 text-center">
            <h1 class="font-titulo text-3xl font-bold text-prosa-cinza">Sinta-se à vontade</h1>
            <p class="text-lg text-prosa-cinza">
                A Prosa surgiu com a intenção de criar relações novas. Aqui, você encontrará
                experiências e oportunidades de se conectar com pessoas diferentes.
            </p>
            <p class="font-titulo text-xl font-bold text-prosa-claro">Que tal uma apresentação, Preparado?</p>
            <button type="button" @click="passo = 2"
                    class="rounded-3xl border-2 border-stone-300 px-10 py-5 font-titulo text-2xl font-bold text-prosa-cinza">
                Claro...
            </button>
        </div>

        {{-- Passo 2: dados do perfil --}}
        <div x-show="passo === 2" x-cloak class="space-y-4">
            <h1 class="text-center font-titulo text-3xl font-bold text-prosa-cinza">Conte sobre você</h1>

            <div>
                <input type="text" name="cidade" value="{{ old('cidade') }}" placeholder="Cidade..." class="prosa-input">
                <x-input-error :messages="$errors->get('cidade')" class="ml-4 mt-1" />
            </div>
            <div>
                <input type="text" name="profissao" value="{{ old('profissao') }}" placeholder="Profissão..." class="prosa-input">
                <x-input-error :messages="$errors->get('profissao')" class="ml-4 mt-1" />
            </div>
            <div>
                <input type="text" name="passatempo" value="{{ old('passatempo') }}" placeholder="Passatempo..." class="prosa-input">
                <x-input-error :messages="$errors->get('passatempo')" class="ml-4 mt-1" />
            </div>
            <div>
                <textarea name="sobre" rows="4" placeholder="Fale um pouco sobre você..."
                          class="prosa-input !rounded-3xl">{{ old('sobre') }}</textarea>
            </div>

            <button type="button" @click="passo = 3" class="prosa-btn">Continuar</button>
        </div>

        {{-- Passo 3: interesses --}}
        <div x-show="passo === 3" x-cloak class="space-y-6 text-center">
            <h1 class="font-titulo text-3xl font-bold text-prosa-cinza">Do que você gosta?</h1>

            <div class="flex flex-wrap justify-center gap-3">
                @foreach ($interesses as $interesse)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="interesses[]" value="{{ $interesse->id }}" class="peer sr-only">
                        <span class="inline-block rounded-full border-2 border-stone-300 px-5 py-2 text-lg font-bold text-stone-400
                                     peer-checked:border-prosa-verde peer-checked:bg-prosa-verde peer-checked:text-white">
                            {{ $interesse->nome }}
                        </span>
                    </label>
                @endforeach
            </div>

            <button type="submit" class="prosa-btn">Finalizar</button>
            <button type="button" @click="passo = 2" class="text-sm font-bold text-prosa-cinza underline">Voltar</button>
        </div>

        {{-- Bolinhas de progresso --}}
        <div class="mt-8 flex justify-center gap-3">
            <template x-for="n in 3">
                <span class="h-4 w-4 rounded-full border-2 border-prosa-verde"
                      :class="passo === n ? 'bg-prosa-verde' : ''"></span>
            </template>
        </div>
    </form>
</x-guest-layout>