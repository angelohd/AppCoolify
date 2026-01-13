<?php

namespace App\Livewire\Administrador;

use App\Models\Actividades as ModelsActividades;
use Livewire\Component;

class Actividades extends Component
{
    public $actividades = array();
    public function render()
    {
        $this->actividades = ModelsActividades::orderBy('id', 'desc')->get();
        return view('livewire.administrador.actividades')
            ->layout('components.layouts.app', ['title' => __('Utilizadores')]);
    }
}
