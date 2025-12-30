<?php

namespace App\Livewire\Imovel;

use App\Models\Visita;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VisitasMarcadas extends Component
{
    public $visitas = array();
    public function render()
    {
        $this->visitas = Visita::with(['imovel'])->whereHas('imovel', function ($query) {
            $query->where('aprovado_por', Auth::id());
        })->get();
       //dd($this->visitas);
        return view('livewire.imovel.visitas_marcadas')
            ->layout('components.layouts.app');
    }
}
