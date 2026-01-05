<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twin Search</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* CSS Interno Personalizado */
        :root {
            --tp-red: #980505;
            --tp-black: #0a0a0a;
            --tp-dark-grey: #1a1a1a;
        }

        .tp-background {
            background-color: var(--tp-black);
            background-image: radial-gradient(circle at center, #2d2d2d 0%, #0a0a0a 100%);
            min-height: 100vh;
        }

        /* Padrão Chevron (Zigue-zague) Clássico */
        .chevron-floor {
            background: linear-gradient(135deg, #111 25%, transparent 25%) -50px 0,
                        linear-gradient(225deg, #111 25%, transparent 25%) -50px 0,
                        linear-gradient(315deg, #111 25%, transparent 25%),
                        linear-gradient(45deg, #111 25%, transparent 25%);
            background-size: 100px 100px;
            background-color: #050505;
            height: 150px;
            opacity: 0.4;
        }

        .mystic-glow {
            text-shadow: 0 0 15px rgba(152, 5, 5, 0.7);
        }

        .search-container {
            border: 2px solid var(--tp-red);
            box-shadow: 0 0 30px rgba(152, 5, 5, 0.2);
            transition: all 0.5s ease;
        }

        .search-container:focus-within {
            box-shadow: 0 0 50px rgba(152, 5, 5, 0.4);
            transform: scale(1.02);
        }
    </style>
</head>
<body class="tp-background text-gray-200 font-serif">

    <div class="flex flex-col min-h-screen">
        <!-- Header com Login/Register -->
        <header class="flex justify-end p-8 space-x-6 z-50">
            @if (Route::has('login'))
                <nav class="flex items-center space-x-4">
                    @auth
                        <flux:button href="{{ url('/dashboard') }}" variant="ghost" class="text-white hover:text-[#980505] tracking-widest uppercase text-xs">Entrar na Logia</flux:button>
                    @else
                        <flux:button href="{{ route('login') }}" variant="ghost" class="text-gray-400 hover:text-white uppercase text-xs tracking-tighter">Entrar</flux:button>
                        <flux:button href="{{ route('register') }}" variant="filled" class="bg-[#980505] hover:bg-[#720404] text-white border-none rounded-none px-6">Criar Conta</flux:button>
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Main Content -->
        <main class="flex-grow flex flex-col items-center justify-center px-6 relative">
            <div class="text-center mb-12">
                <h1 class="text-6xl md:text-8xl font-black italic tracking-tighter text-[#980505] mystic-glow">
                    TWIN<span class="text-white">SEARCH</span>
                </h1>
                <p class="text-xs uppercase tracking-[0.5em] text-gray-500 mt-4">As corujas não são o que parecem</p>
            </div>

            <!-- Search Component Wrapper -->
            <div class="w-full max-w-2xl search-container bg-[#0a0a0a] rounded-none p-1">
                <livewire:search-component />
            </div>
        </main>

        <!-- Decorative Floor -->
        <div class="chevron-floor w-full"></div>

        <footer class="p-6 text-center text-[10px] uppercase tracking-[0.3em] text-gray-600">
            © 2026 — Um local seguro para segredos.
        </footer>
    </div>

</body>
</html>
