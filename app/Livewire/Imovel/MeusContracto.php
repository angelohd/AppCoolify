<?php

namespace App\Livewire\Imovel;

use Livewire\Component;
use App\Models\Contracto as ModelsContracto;
use Illuminate\Support\Facades\Auth;

class MeusContracto extends Component
{
    public $contractos = array();
    public function render()
    {
        //dd("aqui");
        $this->contractos = ModelsContracto::where('mediador', Auth::id())->get();
        return view('livewire.imovel.meus_contractos')
            ->layout('components.layouts.app');
    }
}
