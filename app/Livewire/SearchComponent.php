<?php
namespace App\Livewire;

use Livewire\Component;

class SearchComponent extends Component
{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        if (strlen($this->query) > 2) {
            dd($this->query);
            // Exemplo de dados "misteriosos"
            $this->results = ['O café está excelente', 'As corujas não são o que parecem', 'Agente Cooper', 'Log Lady'];
        } else {
            $this->results = [];
        }
    }

    public function render()
    {
        return view('livewire.search-component');
    }
}
