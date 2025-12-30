<?php

namespace App\Livewire\Imovel;

use App\Models\Imovel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class PorAprovarView extends Component
{
    public $imovel = null, $idImovel = null;
    public $decriptado = false;
    public function mount($id)
    {
        try {
            $this->idImovel = Crypt::decrypt($id);
            $this->decriptado = true;
        } catch (\Throwable $th) {
            $this->decriptado = false;
        }

    }
    public function render()
    {
        if ($this->decriptado) {
            $this->imovel = Imovel::find($this->idImovel);
            return view('livewire.imovel.por_aprovar_view')
                ->layout('components.layouts.app');
        }
        dd("404");
    }

    public function Aprovar()
    {
        $imovel = Imovel::where('id', $this->idImovel)->where('aprovado', false)->first();
        if ($imovel) {
            Imovel::where('id', $this->idImovel)->update([
                'aprovado' => true,
                'aprovado_por' => Auth::id(),
            ]);
            session()->flash('success', 'Imovel aprovado e publicado.');
        } else {
            session()->flash('warning', 'Ups! este imovel já foi aprovado por outro utilizador');
        }
    }

    public function Eliminar(){
        Imovel::where('id',$this->idImovel)->delete();
        return redirect()->route('imovel.pessoal');
    }
}
