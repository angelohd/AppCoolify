<?php

namespace App\Livewire\Erro;

use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Erros extends Component
{
    public $decriptado = true, $mensagem;

    public function mount($msg)
    {
        try {
            $this->mensagem = Crypt::decrypt($msg);
            $this->decriptado = true;
        } catch (\Throwable $th) {
            $this->decriptado = false;
        }

    }
    public function render()
    {
        if ($this->decriptado) {
            return view('errors.erro');
        }
        dd("404");
    }
}
