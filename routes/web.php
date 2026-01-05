<?php

use App\Livewire\Erro\Erros;
use App\Livewire\Imovel\ImoveisParaAluguel;
use App\Livewire\Imovel\MeusImoveis;
use App\Livewire\Imovel\PorAprovar;
use App\Livewire\Imovel\PorAprovarView;
use App\Livewire\Imovel\Publicar;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('erro/{msg}',Erros::class)->name('erros');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

        Route::prefix('administrador')->name('administrador.')->group(function(){
            Route::get('utilizadores', \App\Livewire\Administrador\Utilizador::class)->name('utilizadores');
        });

        Route::prefix('imovel')->name('imovel.')->group(function(){
            Route::get('publicar',Publicar::class)->name('publicar');
            Route::get('por/aprovar',PorAprovar::class)->name('por.aprovar');
            Route::get('por/aprovar/previsualziar/{id}',PorAprovarView::class)->name('por.aprovar.view');
            Route::get('pessoal',MeusImoveis::class)->name('pessoal');
            Route::get('para/aluguel/pesquisar',ImoveisParaAluguel::class)->name('pesquisar');
            Route::get('ver/{id}',\App\Livewire\Imovel\ViewImovel::class)->name('ver');
            Route::get('visitas/marcadas',\App\Livewire\Imovel\VisitasMarcadas::class)->name('visitas.marcadas');
            Route::get('visita/marcada/ver/{id}',\App\Livewire\Imovel\ViewVisitaMarcada::class)->name('visita.marcada.view');

            Route::get('entrar/contracto/{id}',\App\Livewire\Imovel\Contracto::class)->name('entrar.contracto');

            Route::get('meus/contractos',\App\Livewire\Imovel\MeusContracto::class)->name('meus.contractos');
            Route::get('/contracto/{id}',\App\Livewire\Imovel\ViewMeuContracto::class)->name('view.contracto');
        });
});
