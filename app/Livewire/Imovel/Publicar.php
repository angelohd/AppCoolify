<?php

namespace App\Livewire\Imovel;

use App\Models\imgens_imovel;
use App\Models\Imovel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Publicar extends Component
{
    use WithFileUploads;
    public $endereco = null, $zona = null, $descricao = null, $preco_renda = null, $observacao = null;
    public $arquivos = [];
    protected $rules = [
        'endereco' => 'required|string|min:3',
        'zona' => 'required',
        'preco_renda' => 'required',
    ];

    public function render()
    {
        return view('livewire.imovel.publicar')
            ->layout('components.layouts.app', ['title' => __('Pulicar imovel')]);
    }

    public function store()
    {
        try {
            //dd($this->arquivos);
            $this->validate();
            if (count($this->arquivos) > 0) {

                $imovel = Imovel::create([
                    'endereco' => $this->endereco,
                    'zona' => $this->zona,
                    'descricao' => $this->descricao,
                    'preco_renda' => $this->preco_renda,
                    'user_id' => Auth::id(),
                    'observacao' => $this->endereco . " " . $this->zona . " " . $this->descricao . " " . $this->preco_renda . " " . Auth::user()->name
                ]);

                $extensao_array = ['jpg', 'png', 'webp'];

                foreach ($this->arquivos as $arquivo) {
                    $extensao = $arquivo->guessExtension();
                    if (in_array($extensao, $extensao_array)) {
                        $nome = round(microtime(true) * 1000) . '.' . $arquivo->getClientOriginalExtension();
                        $arquivo->storeAs('imoveis', $nome, 'public');
                        imgens_imovel::create([
                            'imovel_id' => $imovel->id,
                            'caminho_imagem' => $nome,
                        ]);
                    }
                }
            } else {
                session()->flash('warning', 'Nenhuma imagem selecioanda');
                return;
            }
            $this->reset();
            session()->flash('success', 'Publicação feita com successo, aguarde a aprovação do mediador');
            logActivity('criou a plucação de um imovel', $imovel, [], Auth::id());
        } catch (\Throwable $th) {
            //dd($th);
            session()->flash('error', 'Preencha os campos corretamente.');
        }
    }
}
