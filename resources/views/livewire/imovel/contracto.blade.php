<div class="min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-10 space-y-8">
        <br>

        <!-- Título -->
        <div>
            <h1 class="text-xl font-normal text-gray-800">
                <span class="text-gray-500">Detalhes da Visita Marcada</span>
            </h1>
        </div>

        @if ($decriptado && $visita)
            <!-- Áreas lado a lado -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- Área do Visitante -->
                <div class="border border-gray-100 rounded-xl p-6 bg-gray-50">
                    <h2 class="text-lg text-gray-700 mb-4">
                        👤 Visitante
                    </h2>

                    <p class="text-sm text-gray-600">
                        <strong>Nome:</strong> {{ $visita->getvisitante->name }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Email:</strong> {{ $visita->getvisitante->email }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Telefone:</strong> {{ $visita->getvisitante->pessoa->telefone }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Data da visita:</strong> {{ $visita->data_visita }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Estado:</strong> {{ $visita->status }}
                    </p>
                </div>

                <!-- Área do Proprietário -->
                <div class="border border-gray-100 rounded-xl p-6 bg-gray-50">
                    <h2 class="text-lg text-gray-700 mb-4">
                        🧑‍💼 Proprietário
                    </h2>

                    <p class="text-sm text-gray-600">
                        <strong>Nome:</strong> {{ $visita->imovel->user->name }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Email:</strong> {{ $visita->imovel->user->email ?? '—' }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Telefone:</strong> {{ $visita->imovel->user->pessoa->telefone }}
                    </p>
                </div>

                <!-- Área do Imóvel -->
                <div class="border border-gray-100 rounded-xl p-6 bg-gray-50">
                    <h2 class="text-lg text-gray-700 mb-4">
                        🏠 Imóvel
                    </h2>

                    <p class="text-sm text-gray-600">
                        <strong>Endereço:</strong> {{ $visita->imovel->endereco }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Zona:</strong> {{ $visita->imovel->zona }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <strong>Descrição:</strong> {{ ucfirst($visita->imovel->descricao) }}
                    </p>
                </div>
            </div>
            <br>

            <div class="border border-gray-100 rounded-xl p-6 bg-gray-50 grid grid-cols-3 gap-4">
                <h2 class="text-lg text-gray-700 mb-4">
                    📃 Formulario de contracto
                </h2>

                @if($visita->imovel->disponivel)

                <flux:input type="date" max="2999-12-31" label="Data inicio *" wire:model.defer="data_inicio"
                     />
                <flux:input type="date" max="2999-12-31" label="Data fim *" wire:model.defer="data_fim"  />
                <flux:input label="Valor mensal *" wire:model.defer="valor_mensal"  />
                <flux:input label="Valor caução *" wire:model.defer="valor_caucao"  />
                <flux:textarea label="Observação" wire:model.defer="observacao"  rows="3"
                    placeholder="Observação" />
                    <label for="">Comprovativo de pagamento:</label>
                <input type="file" class="" wire:model="comprovativo_pagamento">

                <div class="flex justify-end gap-2">
                    @include('components.alert')
                    <flux:button wire:click="ConfirmarContarcto" color="green" icon="check-circle">
                        Confirmar
                    </flux:button>

                </div>
                @else
                <div
                class="rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-sm text-green-800 dark:border-green-700 dark:bg-green-900/30 dark:text-green-200">
                Este imovel ainda tem um contracto valido, entre em contacto com o propriestario.</strong>
            </div>
                @endif
            </div>
        @else
            <div class="text-red-500 text-sm">
                Não foi possível carregar os detalhes da visita. Verifique se o link está correto.
            </div>
        @endif

    </div>
</div>
