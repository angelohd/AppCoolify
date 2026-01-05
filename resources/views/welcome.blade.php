<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pesquisa</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #ffffff;
        }

        /* Topo */
        .top-bar {
            display: flex;
            justify-content: flex-end;
            padding: 16px 24px;
        }

        .auth-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .auth-buttons a {
            text-decoration: none;
            font-size: 14px;
            color: #1a73e8;
        }

        .auth-buttons .btn {
            padding: 8px 14px;
            border: 1px solid #1a73e8;
            border-radius: 4px;
            background: #1a73e8;
            color: #fff;
            font-size: 14px;
        }

        .container {
            min-height: calc(100vh - 500px);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content {
            width: 100%;
            max-width: 90%;
            padding: 20px;
            text-align: center;
        }

        .logo {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 30px;
            letter-spacing: -2px;
        }

        .logo span:nth-child(1) {
            color: #4285F4;
        }

        .logo span:nth-child(2) {
            color: #EA4335;
        }

        .logo span:nth-child(3) {
            color: #FBBC05;
        }

        .logo span:nth-child(4) {
            color: #4285F4;
        }

        .logo span:nth-child(5) {
            color: #34A853;
        }

        .logo span:nth-child(6) {
            color: #EA4335;
        }

        .search-box {
            display: flex;
            align-items: center;
            border: 1px solid #dcdcdc;
            border-radius: 24px;
            padding: 10px 16px;
        }

        .search-box input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 16px;
        }

        .buttons {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .buttons button {
            background: #f8f9fa;
            border: 1px solid #f8f9fa;
            border-radius: 4px;
            padding: 10px 16px;
            font-size: 14px;
            cursor: pointer;
        }

        @media (max-width: 480px) {
            .logo {
                font-size: 36px;
            }
        }
    </style>

    <style>
        .results {
            margin-top: 40px;
            text-align: left;
        }

        .result-item {
            margin-bottom: 24px;
        }

        .result-item a {
            text-decoration: none;
        }

        .result-item h3 {
            margin: 0;
            font-size: 18px;
            color: #1a0dab;
            font-weight: normal;
        }

        .result-item h3:hover {
            text-decoration: underline;
        }

        .result-item .url {
            font-size: 14px;
            color: #006621;
            margin: 4px 0;
        }

        .result-item p {
            margin: 0;
            font-size: 14px;
            color: #4d5156;
            line-height: 1.4;
        }

        .no-results {
            margin-top: 40px;
            color: #777;
            font-size: 14px;
        }
    </style>


</head>

<body>

    <!-- TOPO -->
    <div class="top-bar">
        <div class="auth-buttons" id="authArea">
            @auth
                <a href="{{ route('imovel.pesquisar') }}">{{ Auth::user()->name }}</a>
            @else
                <a href="{{ route('login') }}">Iniciar sessão</a>
                <a href="{{ route('register') }}" class="btn">Criar conta</a>
            @endauth

        </div>
    </div>

    <!-- CONTEÚDO -->
    <div class="container">
        <div class="content">
            <div class="logo">
                <span>A</span><span>l</span><span>u</span><span>g</span><span>a</span><span>Fácil</span>
            </div>

            <form action="{{ route('pesquisar.imovel') }}" method="GET">
                <div class="search-box">
                    <input type="text" name="q" placeholder="Pesquisar..." value="{{ request('q') }}" />
                    <button type="submit">Pesquisa</button>
                </div>
            </form>

            @if (request()->filled('q'))
                <div class="results">

                    @forelse($imoveis as $imovel)
                        <div class="result-item">
                            <a href="{{ route('imovel.ver',$imovel->id) }}"> <h3>{{ $imovel->zona }} - {{ $imovel->endereco }}</h3></a>

                            <div class="url">
                                {{ route('imovel.ver', $imovel->id) }}
                            </div>

                            <p>
                                {{ Str::limit($imovel->descricao, 160) }}
                            </p>
                            <div class="flex flex-wrap gap-5 text-xs text-gray-500 pt-1">
                                <span>👤 {{ $imovel->user->name ?? 'Anônimo' }}</span>
                                <span> 💰 {{ number_format($imovel->preco_renda, 2, ',', '.') }} Kz</span>
                                <span> 📅 {{ $imovel->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="no-results">
                            Nenhum resultado encontrado para
                            <strong>"{{ request('q') }}"</strong>
                        </div>
                    @endforelse

                </div>
            @endif




        </div>



    </div>


</body>

</html>
