<div class="relative w-full">
    <div class="flex items-center px-6 py-4">
        <flux:icon.magnifying-glass class="size-6 text-[#980505]" />
        <input
            wire:model.live.debounce.400ms="query"
            type="text"
            placeholder="Pergunte ao tronco..."
            class="w-full bg-transparent border-none focus:ring-0 text-white font-serif italic text-xl px-4 placeholder-gray-700"
        />
    </div>

    <!-- Resultados estilo "Black Lodge" -->
    @if(!empty($results))
        <div class="absolute w-full left-0 mt-2 bg-[#0a0a0a] border-t-2 border-[#980505] z-50">
            <ul class="py-2">
                @foreach($results as $result)
                    <li class="px-8 py-4 hover:bg-[#980505] hover:text-white cursor-pointer transition-all duration-300 flex items-center justify-between group">
                        <span class="tracking-wide">{{ $result }}</span>
                        <span class="opacity-0 group-hover:opacity-100 text-xs tracking-widest">VER →</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
