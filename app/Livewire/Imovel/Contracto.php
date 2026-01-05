<?php

namespace App\Livewire\Imovel;

use App\Models\Contracto as ModelsContracto;
use App\Models\Imovel;
use Livewire\Component;
use App\Models\Visita;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Contracto extends Component
{
    use WithFileUploads;
    public $idVisita = null, $visita = null, $decriptado = false, $idEncrypt = null;
    public $data_inicio = null, $data_fim = null, $valor_mensal = null, $valor_caucao = null, $observacao = null, $comprovativo_pagamento = null;

    protected $rules = [
        'data_inicio' => 'required|date',
        'data_fim' => 'required|date',
        'valor_mensal' => 'required',
        'valor_caucao' => 'required',
    ];
    public function mount($id)
    {
        try {
            $this->idEncrypt = $id;
            $this->idVisita = decrypt($id);
            $this->visita = Visita::find($this->idVisita);
            $this->decriptado = true;
        } catch (\Exception $e) {
            $this->decriptado = false;
        }
    }
    public function render()
    {
        if ($this->decriptado) {
            return view('livewire.imovel.contracto')
                ->layout('components.layouts.app');
        }
        dd($this->decriptado, $this->idVisita);

    }

    public function ConfirmarContarcto()
    {
        try {
            $this->validate();
            $extensao_array = ['jpg', 'png', 'webp'];
            if ($this->comprovativo_pagamento) {
                $extensao = $this->comprovativo_pagamento->guessExtension();
                if (in_array($extensao, $extensao_array)) {
                    $nome = round(microtime(true) * 1000) . '.' . $this->comprovativo_pagamento->getClientOriginalExtension();
                    $this->comprovativo_pagamento->storeAs('comprovativos_pagamentos', $nome, 'public');
                    $this->comprovativo_pagamento = $nome;
                }
            }
            ModelsContracto::create([
                'imovel_id' => $this->visita->imovel_id,
                'inquilono' => $this->visita->visitante,
                'mediador' => Auth::id(),
                'data_inicio' => $this->data_inicio,
                'data_fim' => $this->data_fim,
                'valor_mensal' => $this->valor_mensal,
                'status' => 'ativo',
                'valor_caucao' => $this->valor_caucao,
                'observacao' => $this->observacao,
                'comprovativo_pagamento' => $this->comprovativo_pagamento,
            ]);
            Imovel::where('id',$this->visita->imovel_id)->update([
                'disponivel'=>false,
            ]);
            //$this->reset();
            session()->flash('success', 'Contracto feito com successo');
        } catch (\Throwable $th) {
            //dd($th);
            session()->flash('error', 'Preencha os campos corretamente.');
        }
    }
}
