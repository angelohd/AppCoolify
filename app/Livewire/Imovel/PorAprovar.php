<?php

namespace App\Livewire\Imovel;

use App\Models\Imovel;
use Livewire\Component;

class PorAprovar extends Component
{
    public $imoveis = array();
    public function render()
    {
        $this->imoveis = Imovel::with(['user.pessoa'])
            ->where('aprovado', false)
            ->get();
        return view('livewire.imovel.por_aprovar')
            ->layout('components.layouts.app', ['title' => __('Imovel por aprovar')]);
    }
}
