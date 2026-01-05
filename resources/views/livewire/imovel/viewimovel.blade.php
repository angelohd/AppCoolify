<div class="min-h-screen">

    <!-- Galeria de Imagens -->
    {{--
    <div class="max-w-6xl mx-auto px-4 pt-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Imagem principal -->
            <div class="md:col-span-2">
                <img src="{{ url('storage/imoveis/' . $imovel->imagens->first()->caminho_imagem) }}" alt="Imagem do imóvel"
                    class="w-full h-[420px] object-cover rounded-xl">
            </div>
        </div>
        <!-- Imagens secundárias -->

    </div>
     --}}

    <!-- Conteúdo -->
    <div class="flex justify-end gap-2">

        <flux:link href="/" color="orange">
            nova pesquisa
        </flux:link>

    </div>
    <div class="max-w-4xl mx-auto px-4 py-10 space-y-8">

        <!-- Título -->
        <div>
            <h1 class="text-3xl font-normal text-gray-800">
                <span class="text-gray-500">Endereço: </span> {{ $imovel->endereco }}
            </h1>
            <p><span class="text-gray-500">Zona:</span> {{ $imovel->zona }}</p>
        </div>

        <!-- Preço -->
        <div class="text-2xl text-blue-600 font-medium">
            💰 {{ number_format($imovel->preco_renda, 2, ',', '.') }} Kz/mês
        </div>

        <!-- Destaques -->
        {{--
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-sm text-gray-600">
            <div>📐 {{ $imovel->area }} m²</div>
            <div>🛏️ {{ $imovel->quartos }} Quartos</div>
            <div>🚿 {{ $imovel->banheiros }} Banheiros</div>
            <div>🏷️ {{ $imovel->tipo }}</div>
        </div>
         --}}

        <!-- Descrição -->
        <div>
            <h2 class="text-lg text-gray-700 mb-2">Descrição</h2>
            <p class="text-gray-600 leading-relaxed">
                {{ $imovel->descricao }}
            </p>
        </div>

        <!-- Informações adicionais -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-600">
            <div>
                <p><span class="text-gray-500">Publicado em:</span> {{ $imovel->created_at->format('d/m/Y') }}</p>
                <p><span class="text-gray-500">Propritario:</span> {{ $imovel->user->name }}</p>
                <p><span class="text-gray-500">Mediador:</span> {{ $imovel->user_aprovado->name }} // Telefone:
                    {{ $imovel->user->pessoa->telefone }}</p>
                <p><span class="text-gray-500">Disponível:</span> {{ $imovel->disponivel ? 'Sim' : 'Não' }}</p>
            </div>
        </div>

    </div>
    <hr>
    <h1 class="text-green-600 text-center">imangens da casa</h1>
    <div class="grid grid-cols-5 gap-4 mt-4 md:grid">
        @foreach ($imovel->imagens as $imagem)
            <img src="{{ url('storage/imoveis/' . $imagem->caminho_imagem) }}"
                class="w-full h-[200px] object-cover rounded-sm cursor-pointer hover:opacity-90">
        @endforeach
    </div>

    <div class="max-w-4xl mx-auto px-4 py-10 space-y-4">
        <br>
        @include('components.alert')
        <flux:input type="date" max="2999-12-31" label="Data da visita" wire:model.defer="data_visita" required />
        <flux:button wire:click="AgendarVisita" color="green" icon="calendar">
            Agendar Visita
        </flux:button>
    </div>
</div>
