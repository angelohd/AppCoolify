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
                    <flux:button wire:click="Aprovar" color="green" icon="user-plus">
                        Aprovar para publicação
                    </flux:button>

                </div>
            @else
                <div class="flex justify-end gap-2">
                    @include('components.alert')
                    <flux:button wire:click="Eliminar" color="danger">
                        Apagar publicação
                    </flux:button>

                </div>
            @endif
        @endif


    </div>

</div>
