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
                        {{ count($contractos) }}
                    </span>
                    <span class="block text-lg md:text-xl text-zinc-600 dark:text-zinc-400">
                        Contractos feitos
                    </span>
                </div>
            </div>
        </div>
    </div>

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
                @forelse($contractos as $cc)
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
