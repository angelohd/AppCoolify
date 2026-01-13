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
                        {{ count($actividades) }}
                    </span>
                    <span class="block text-lg md:text-xl text-zinc-600 dark:text-zinc-400">
                        Utilizadores Registados
                    </span>
                </div>
            </div>

        </div>
    </div>

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
                        Utilizador
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                        Descrição
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                        Rota
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                        User-agente
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                        Metodo
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-zinc-600 dark:text-zinc-400">
                        IP
                    </th>

                </tr>
            </thead>

            <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse($actividades as $user)
                    @php
                        // Converte o JSON para array. Se já for array/objeto, o json_decode lidará com isso.
                        $props = is_array($user->properties) ? $user->properties : json_decode($user->properties, true);
                    @endphp
                    <tr class="">
                        <td class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                            {{ $user->getUser->name }}
                        </td>
                        <td class="px-4 py-3 text-sm text-zinc-900 dark:text-white">
                            {{ Str::limit($user->description, 60, '...') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                            {{ Str::limit($props['rota'] ?? 'N/A', 60, '...') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                            {{ $props['agente'] ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                           {{ $props['metodo'] ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3">
                            <flux:badge>
                               {{ $props['ip'] ?? 'N/A' }}
                            </flux:badge>
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
