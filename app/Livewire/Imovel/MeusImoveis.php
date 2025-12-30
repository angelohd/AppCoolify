<?php

namespace App\Livewire\Imovel;

use Livewire\Component;
use App\Models\Imovel;
use Illuminate\Support\Facades\Auth;

class MeusImoveis extends Component
{
    public $imoveis = array();
    public function render()
    {
        $this->imoveis = Imovel::with(['user.pessoa'])
            ->where('user_id', Auth::id())
            ->get();
        return view('livewire.imovel.por_aprovar')
            ->layout('components.layouts.app', ['title' => __('Imovel por aprovar')]);
    }
}
