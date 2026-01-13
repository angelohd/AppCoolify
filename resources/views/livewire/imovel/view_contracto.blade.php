<div class="min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-10 space-y-8">
        <br>

        <!-- Título -->
        <div>
            <h1 class="text-xl font-normal text-gray-800">
                <span class="text-gray-500">Detalhes do contarcto</span>
            </h1>
        </div>

        @if ($decriptado && $contarcto)
            <!-- Áreas lado a lado -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- Área do Visitante -->
                <div class="border border-gray-100 rounded-xl p-6 bg-gray-50">
                    <h2 class="text-lg text-gray-700 mb-4">
                        👤 Inquilino
                    </h2>

                    <p class="text-sm text-gray-600">
                        <strong>Nome:</strong> {{ $contarcto->getinquilono->name }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Email:</strong> {{ $contarcto->getinquilono->email }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Telefone:</strong> {{ $contarcto->getinquilono->pessoa->telefone }}
                    </p>
                </div>

                <!-- Área do Proprietário -->
                <div class="border border-gray-100 rounded-xl p-6 bg-gray-50">
                    <h2 class="text-lg text-gray-700 mb-4">
                        🧑‍💼 Proprietário
                    </h2>

                    <p class="text-sm text-gray-600">
                        <strong>Nome:</strong> {{ $contarcto->imovel->user->name }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Email:</strong> {{ $contarcto->imovel->user->email ?? '—' }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Telefone:</strong> {{ $contarcto->imovel->user->pessoa->telefone }}
                    </p>
                </div>

                <!-- Área do Imóvel -->
                <div class="border border-gray-100 rounded-xl p-6 bg-gray-50">
                    <h2 class="text-lg text-gray-700 mb-4">
                        🏠 Imóvel
                    </h2>

                    <p class="text-sm text-gray-600">
                        <strong>Endereço:</strong> {{ $contarcto->imovel->endereco }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Zona:</strong> {{ $contarcto->imovel->zona }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Descrição:</strong> {{ ucfirst($contarcto->imovel->descricao) }}
                    </p>
                </div>

                <!-- Área do Imóvel -->
                <div class="border border-gray-100 rounded-xl p-6 bg-gray-50">
                    <h2 class="text-lg text-gray-700 mb-4">
                        📃 Dados do contracto
                    </h2>

                    <p class="text-sm text-gray-600">
                        <strong>Data de inicio:</strong> {{ $contarcto->data_inicio }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Data fim:</strong> {{ $contarcto->data_fim }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Valor mensal:</strong> {{ number_format($contarcto->valor_mensal, 2, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Valor caução:</strong> {{ number_format($contarcto->valor_caucao, 2, ',', '.') }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Observação:</strong> {{ $contarcto->observacao }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Estado:</strong> {{ $contarcto->status }}
                    </p>

                </div>

            </div>
            <br>
            @include('components.alert')
            <flux:link href="#">
                📃 Imprimir
            </flux:link>


            @if ($contarcto->status == 'ativo')
                @if (Auth::id() == $contarcto->imovel->user_id)
                    <flux:button wire:click="EncerarContarcto" color="green" icon="check-circle">
                        ❌ Encerar contracto
                    </flux:button>
                @endif
            @endif
        @else
            <div class="text-red-500 text-sm">
                Não foi possível carregar os detalhes da visita. Verifique se o link está correto.
            </div>
        @endif

    </div>
</div>
