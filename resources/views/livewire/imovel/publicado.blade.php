<div class="p-6 space-y-6 max-w-4xl mx-auto">

    <!-- Barra de pesquisa -->
    <div class="flex gap-2">
        <flux:input
            type="search"
            placeholder="Pesquisar imóvel, endereço, utilizador..."
            wire:model.live="search"
            class="w-full rounded-full px-6 py-3 border border-gray-200
                   focus:border-blue-400 focus:ring-2 focus:ring-blue-100
                   shadow-sm bg-white text-gray-800 placeholder-gray-400"
        />
    </div>

    <!-- Resultados -->
    <div class="space-y-10">
        @forelse ($imoveis as $item)
            <div class="space-y-1">
                <!-- Caminho / URL -->
                {{--
                <p class="text-xs text-gray-400">
                    imoveis.ndaysystem.com › {{ $item->categoria ?? 'residencial' }}
                </p>
                 --}}


                <!-- Título -->
                <h2 class="text-xl font-normal text-blue-600 hover:underline cursor-pointer">
                    <a href="{{ route('imovel.ver',$item->id) }}">{{ $item->zona }} - {{ $item->endereco }}</a>

                </h2>
                {{--
                <!-- Endereço + Data -->
                <p class="text-sm text-gray-500">
                    {{ $item->descricao }} ·
                    {{ $item->created_at->format('d/m/Y') }}
                </p>
                --}}

                <!-- Descrição -->
                <p class="text-sm text-gray-600 leading-relaxed max-w-3xl">
                    {{ Str::limit($item->descricao, 180) }}
                </p>

                <!-- Metadados -->
                <div class="flex flex-wrap gap-5 text-xs text-gray-500 pt-1">
                    <span>👤 {{ $item->user->name ?? 'Anônimo' }}</span>
                    <span> 💰 {{ number_format($item->preco_renda, 2, ',', '.') }} Kz</span>
                    <span> 📅 {{ $item->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            <hr>
        @empty
            <p class="text-center text-gray-400 text-blue-600">
                Nenhum imóvel encontrado.
            </p>
        @endforelse
    </div>
</div>
