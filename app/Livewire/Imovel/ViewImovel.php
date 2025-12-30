<?php

namespace App\Livewire\Imovel;

use App\Models\Visita;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class ViewImovel extends Component
{
    public $idMovel = null, $imovel = null, $data_visita = null;
    public function mount($id)
    {
        $this->idMovel = $id;
    }
    public function render()
    {
        $this->imovel = \App\Models\Imovel::with(['user.pessoa'])->where('id', $this->idMovel)->first();
        return view('livewire.imovel.viewimovel')
            ->layout('components.layouts.app', ['title' => __('Imovel por aprovar')]);
    }

    public function AgendarVisita()
    {
        $this->validate([
            'data_visita' => ['required', 'date'],
        ], [
            'data_visita.required' => 'Por favor selecione a data da visita.',
            'data_visita.date' => 'A data da visita não é válida.',
        ]);
        if ($this->imovel->user_id === Auth::id()) {
            session()->flash('error', 'Não é permitido marcar visita para o seu próprio imóvel.');
            return;
        }
        $dataVisita = Carbon::parse($this->data_visita)->startOfDay();
        $hoje = Carbon::now()->startOfDay();
        if ($dataVisita->lessThan($hoje)) {
            session()->flash('error', 'Não é possível marcar visita para uma data anterior.');
            return;
        }
        if ($dataVisita->lessThan($hoje->addDays(3))) {
            session()->flash('error', 'A visita deve ser marcada com pelo menos 3 dias de antecedência.');
            return;
        }
        Visita::create([
            'imovel_id' => $this->imovel->id,
            'visitante' => Auth::id(),
            'data_visita' => $dataVisita,
            'status' => 'pendente',
        ]);

        session()->flash('success', 'Visita agendada com sucesso.');
    }
}
