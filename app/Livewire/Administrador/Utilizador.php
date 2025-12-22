<?php

namespace App\Livewire\Administrador;

use App\Models\Categoria;
use App\Models\Pessoa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Utilizador extends Component
{
    use WithPagination;
    public $users = array(), $categorias = array();
    protected $paginationTheme = 'tailwind';
    public function render()
    {
        $this->categorias = Categoria::all();
        $this->users = User::with(['pessoa', 'categoria'])->get();
        //$users = User::paginate(100);
        //dd($users);
        return view('livewire.administrador.utilizadores')
            ->layout('components.layouts.app', ['title' => __('Utilizadores')]);
    }

    public $nome;
    public $numero;
    public $telefone;
    public $email;
    public $categoria_id;

    protected $rules = [
        'nome' => 'required|string|min:3',
        'email' => 'required|email',
        'categoria_id' => 'required|exists:categorias,id',
    ];

    public function store()
    {
        try {
            $this->validate();
            if ($this->numero) {
                $identidadeExist = Pessoa::where('numero_identidade', $this->numero)->first();
                if ($identidadeExist) {
                    session()->flash('warning', 'Número de identidade informado já existe registado.');
                    return;
                }
            }

            $emailExist = User::where('email', $this->email)->first();
            if ($emailExist) {
                session()->flash('warning', 'Email informado já existe registado.');
                return;
            }

            $pessoa = Pessoa::create([
                'nome' => $this->nome,
                'numero_identidade' => $this->numero,
                'telefone' => $this->telefone,
            ]);

            User::create([
                'name' => $this->nome,
                'email' => $this->email,
                'password' => Hash::make('123456Sete'),
                'pessoa_id' => $pessoa->id,
                'categoria_id' => $this->categoria_id,
            ]);

            $this->reset();
            session()->flash('success', 'Utilizador registado com sucesso.');
        } catch (\Throwable $th) {
            //dd($th);
            session()->flash('error', 'Preencha os campos corretamente.');
        }
    }

    public function clear()
    {
        $this->reset();
    }
}
