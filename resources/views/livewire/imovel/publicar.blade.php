<div class="p-6 space-y-6">
    <div class="p-6 max-w-3xl space-y-6">

        <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">
            Publicar imovel
        </h2>
        <div class="grid gap-4">
            <div class="grid grid-cols-3 gap-4">
                <flux:textarea label="Endereço: *" wire:model.defer="endereco" required rows="1"
                    placeholder="Endereço" />
                <flux:select label="Zona: *" wire:model.defer="zona" required>
                    <option hidden>Selecione a categoria</option>
                    <option value="Urbana">Urbana</option>
                    <option value="Suburbana">Suburbana</option>
                </flux:select>
                <flux:input label="Preço de arrendamento: *" wire:model.defer="preco_renda" />
                <flux:textarea label="Descrição: *" wire:model.defer="descricao" placeholder="Descrição da casa"
                    rows="1" />
                <input type="file" class="form-control file" multiple name="filepond" data-allow-reorder="true"
                    data-max-file-size="3MB" data-max-files="5" wire:model="arquivos">
            </div>
        </div>

        <div class="flex justify-end gap-2">
            @include('components.alert')
            <flux:button wire:click="store" color="green" icon="check-circle">
                Publicar
            </flux:button>

        </div>

        @if ($arquivos)
            <div class="col-md-12 row g-2 mt-2">
                @foreach ($arquivos as $arquivo)
                    <div class="col">
                        <img src="{{ $arquivo->temporaryUrl() }}" class="img-fluid"
                            alt="{{ $arquivo->getClientOriginalName() }}">
                    </div>
                @endforeach


            </div>
        @endif

    </div>
</div>
