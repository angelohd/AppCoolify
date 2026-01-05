<?php

namespace App\Livewire\Imovel;

use App\Models\Imovel;
use Livewire\Component;

class ImoveisParaAluguel extends Component
{
    public $search = null, $imoveis = array();
    public function render()
    {
        if ($this->search) {
            $this->imoveis = Imovel::with(['user_aprovado'])
                ->where('aprovado', true)
                ->where('disponivel', true)
                ->where('observacao', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $this->imoveis = Imovel::with(['user_aprovado'])
                ->where('aprovado', true)
                ->where('disponivel', true)
                ->orderBy('id', 'desc')
                ->take(100)
                ->get();
        }
        return view('livewire.imovel.publicado')
            ->layout('components.layouts.app');
    }
}
