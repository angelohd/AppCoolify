<?php

namespace App\Livewire\Administrador;

use App\Models\Categoria;
use App\Models\Pessoa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    public $categoria_id, $idUser, $idPessoa, $editar = false;
    public $info = "Registar Utilizador";

    protected $rules = [
        'nome' => 'required|string|min:3',
        'email' => 'required|email',
        'categoria_id' => 'required|exists:categorias,id',
    ];

    public function store()
    {
        try {
            $this->validate();
            if ($this->editar) {
                Pessoa::where('id', $this->idPessoa)->update([
                    'nome' => $this->nome,
                    'numero_identidade' => $this->numero,
                    'telefone' => $this->telefone,
                ]);

                User::where('id', $this->idUser)->update([
                    'name' => $this->nome,
                    'email' => $this->email,
                    'categoria_id' => $this->categoria_id,
                ]);

                session()->flash('success', 'Utilizador actualizado com sucesso.');
                logActivity('Actualisou dados de um utilizador', null, [], Auth::id());
                $this->clear();
                return;

            }
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


            session()->flash('success', 'Utilizador registado com sucesso.');
            logActivity('Registrou um utilizador', $pessoa, [], Auth::id());
            $this->clear();
        } catch (\Throwable $th) {
            //dd($th);
            session()->flash('error', 'Preencha os campos corretamente.');
        }
    }

    public function clear()
    {
        $this->info = "Registar Utilizador";
        $this->idUser = null;
        $this->idPessoa = null;
        $this->editar = false;
        $this->reset();
    }

    public function EditarUser($id)
    {
        $this->clear();
        $user = User::find($id);
        $this->nome = $user->name;
        $this->email = $user->email;
        $this->categoria_id = $user->categoria_id;
        $this->numero = $user->pessoa->numero_identidade;
        $this->telefone = $user->pessoa->telefone;
        $this->idUser = $id;
        $this->editar = true;
        $this->info = "Actualizar dados do utilizador";
        $this->idPessoa = $user->pessoa_id;
    }
}
