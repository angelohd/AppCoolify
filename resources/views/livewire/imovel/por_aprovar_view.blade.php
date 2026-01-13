<div class="p-6 space-y-6">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @if ($imovel->aprovado)
            <div
                class="rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-sm text-green-800 dark:border-green-700 dark:bg-green-900/30 dark:text-green-200">
                Imovel aprovado por: <strong>{{ $imovel->user_aprovado->name }}</strong>
            </div>
        @endif
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="">
                <div class="relative z-10">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Dados do propriestario</h2>
                    <hr><br>
                    <flux:input label="Nome:" value="{{ $imovel->user->pessoa->nome }}" />
                    <flux:input label="Telefone:" value="{{ $imovel->user->pessoa->telefone }}" />
                    <flux:input label="E-mail:" value="{{ $imovel->user->email }}" />

                </div>
            </div>

            <div class="">
                <div class="relative z-10">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Dados da casa</h2>
                    <hr><br>
                    <flux:input label="Endereço:" value="{{ $imovel->endereco }}" />
                    <flux:input label="Zona:" value="{{ $imovel->zona }}" />
                    <flux:input label="Zona:" value="{{ $imovel->zona }}" />
                    <flux:input label="Preço de arrendamento:" value="{{ number_format($imovel->preco_renda, 2) }}" />
                    <flux:input label="Descrição:" value="{{ $imovel->descricao }}" />

                </div>
            </div>

            <div class="">
                <div class="relative z-10">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Imagens disponiveis</h2>
                    <hr><br>

                    @foreach ($imovel->imagens as $item)
                        <img src="{{ url('storage/imoveis/' . $item->caminho_imagem) }}" alt="">
                    @endforeach

                </div>
            </div>


        </div>
        @if (!$imovel->aprovado)
            @if (Auth::id() != $imovel->user_id)
                <hr>
                <div class="flex justify-end gap-2">
                    @include('components.alert')
                    <flux:button wire:click="Aprovar" color="green" icon="check-circle">
                        Aprovar para publicação
                    </flux:button>

                </div>
            @else
                <div class="flex justify-end gap-2">
                    @include('components.alert')
                    <flux:button wire:click="Eliminar" color="danger" icon="check-circle">
                        Apagar publicação
                    </flux:button>

                </div>
            @endif
        @endif
        <hr>
        <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Contractos</h2>
        <div class="w-full overflow-x-auto rounded-lg border border-zinc-200 dark:border-zinc-700">
            <table class="w-full table-auto divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-50 dark:bg-zinc-900">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                            Nº
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                            Proprietario
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                            Data inicio
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                            Data fim
                        </th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                            Estado
                        </th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-zinc-600 dark:text-zinc-400">
                            Ações
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($imovel->contractos as $cc)
                        @php
                            $idEncrypt = Crypt::encrypt($cc->id);
                        @endphp
                        <tr class="">
                            <td class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                                {{ $cc->imovel->user->name }}
                            </td>
                            <td class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                                {{ $cc->data_inicio }}
                            </td>
                            <td class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                                {{ $cc->data_fim }}
                            </td>

                            <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                <flux:badge :color="$cc->status == 'ativo' ? 'green' : 'red'">
                                    {{ $cc->status }}
                                </flux:badge>
                            </td>

                            <td class="px-4 py-3 text-right">
                                <flux:link href="{{ route('imovel.view.contracto', $idEncrypt) }}">
                                    Detalhes
                                </flux:link>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-sm text-zinc-500">
                                Nenhum utilizador encontrado
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>

</div>
