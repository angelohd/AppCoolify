<?php

namespace App\Livewire\Imovel;

use App\Models\Contracto;
use App\Models\Imovel;
use Livewire\Component;

class ViewMeuContracto extends Component
{
    public $idContracto = null, $contarcto = null, $decriptado = false;
    public function mount($id)
    {
        try {
            $this->idContracto = decrypt($id);
            $this->decriptado = true;
        } catch (\Exception $e) {
            $this->decriptado = false;
        }
    }
    public function render()
    {
        //dd("aqui");
        if ($this->decriptado) {
            $this->contarcto = Contracto::find($this->idContracto);
            if ($this->contarcto) {
                //dd($this->contarcto->getinquilono);
                return view('livewire.imovel.view_contracto')
                    ->layout('components.layouts.app');
            }

        }
        dd("404");

    }

    public function EncerarContarcto()
    {
        Contracto::where('id', $this->idContracto)->update([
            'status' => 'encerrado',
        ]);
        Imovel::where('id',$this->contarcto->imovel_id)->update([
            'disponivel'=>true,
        ]);
        session()->flash('success', 'Contracto encerado');
    }
}
