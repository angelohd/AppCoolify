<?php

namespace App\Livewire\Imovel;

use Livewire\Component;
use App\Models\Visita;
use Illuminate\Support\Facades\Auth;

class ViewVisitaMarcada extends Component
{
    public $idVisita = null, $visita = null, $decriptado = false,$idEncrypt = null;
    public function mount($id)
    {
        try {
            $this->idEncrypt = $id;
            $this->idVisita = decrypt($id);
            $this->decriptado = true;
        } catch (\Exception $e) {
            $this->decriptado = false;
        }
    }
    public function render()
    {
        if ($this->decriptado) {
            $this->visita = Visita::find($this->idVisita);
            return view('livewire.imovel.view_visita')
                ->layout('components.layouts.app');
        }
        dd("aqui");

    }

    public function ConfiguracaoVisita($estado)
    {
        $estados = ['pendente', 'cancelado', 'em_curso', 'concluido', 'confirmada'];
        if (in_array($estado, $estados)) {
            Visita::where('id', $this->idVisita)->update(['status' => $estado]);
            session()->flash('success', 'Visita ' . $estado . ' com sucesso!');
            logActivity('Estado da visita actualizado para '.$estado, null, [], Auth::id());
        }
    }

    public function ConfirmarVisita()
    {
        Visita::where('id', $this->idVisita)->update(['status' => 'confirmada']);
        logActivity('Visita confirmada com sucesso!', null, [], Auth::id());
        session()->flash('success', 'Visita confirmada com sucesso!');
    }
    public function CancelarVisita()
    {
        Visita::where('id', $this->idVisita)->update(['status' => 'cancelado']);
        logActivity('Cancelou uma visita', null, [], Auth::id());
        session()->flash('success', 'Visita cancelado com sucesso!');
    }
}
