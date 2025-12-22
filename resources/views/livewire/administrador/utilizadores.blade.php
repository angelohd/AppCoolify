<div class="p-6 space-y-6">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex items-center justify-center">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />

                <!-- Número de utilizadores -->
                <div class="relative z-10 text-center">
                    <span class="block text-5xl md:text-6xl font-bold text-zinc-900 dark:text-white">
                        {{ count($users) }}
                    </span>
                    <span class="block text-lg md:text-xl text-zinc-600 dark:text-zinc-400">
                        Utilizadores Registados
                    </span>
                </div>
            </div>

            <!-- Card 2: Exemplo placeholder -->
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex items-center justify-center">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />

                <div class="relative z-10 text-center">
                    <span class="block text-5xl md:text-6xl font-bold text-zinc-900 dark:text-white">
                        42
                    </span>
                    <span class="block text-lg md:text-xl text-zinc-600 dark:text-zinc-400">
                        Outro dado
                    </span>
                </div>
            </div>

        </div>
    </div>


    <div class="p-6 max-w-3xl space-y-6">

        <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">
            Registar Utilizador
        </h2>
        <div class="grid gap-4">
            <div class="grid grid-cols-3 gap-4">
                <flux:input label="Nome completo: *" wire:model.defer="nome" required/>
                <flux:input label="Número de Identidade:" wire:model.defer="numero" />
                <flux:input label="Telefone:" wire:model.defer="telefone" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <flux:input type="email" label="Email: *" wire:model.defer="email" required/>

                <flux:select label="Categoria: *" wire:model.defer="categoria_id" required>
                    <option hidden>Selecione a categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">
                            {{ $categoria->categoria }}
                        </option>
                    @endforeach
                </flux:select>
            </div>
        </div>

        <div class="flex justify-end gap-2">
            @include('components.alert')

            <flux:button icon="check" wire:click="store" color="green" icon="user-plus">
                Registar Utilizador
            </flux:button>

        </div>

    </div>




    <!-- Tabela -->

    <div class="flex gap-2">
        <flux:input type="search" placeholder="Pesquisar utilizador..." wire:model.live="search" class="w-100" />
    </div>
    <div class="w-full overflow-x-auto rounded-lg border border-zinc-200 dark:border-zinc-700">
        <table class="w-full table-auto divide-y divide-zinc-200 dark:divide-zinc-700">
            <thead class="bg-zinc-50 dark:bg-zinc-900">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                        Nº
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                        Nome
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                        Nº Identificação
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                        Email
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                        Categoria
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
                @forelse($users as $user)
                    <tr class="">
                        <td class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                            {{ $user->pessoa->nome }}
                        </td>
                        <td class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                            {{ $user->pessoa->numero_identidade }}
                        </td>
                        <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                            {{ $user->email }}
                        </td>
                        <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                            {{ $user->categoria->categoria }}
                        </td>
                        <td class="px-4 py-3">
                            <flux:badge :color="$user->ativo ? 'green' : 'red'">
                                {{ $user->ativo ? 'Ativo' : 'Inativo' }}
                            </flux:badge>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <flux:button size="sm" variant="ghost" icon="pencil">
                                Editar
                            </flux:button>
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
