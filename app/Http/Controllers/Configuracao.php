<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Configuracao extends Controller
{
    public function chekUser()
    {
        $user = Auth::user();
    }

    public function PesquisarImovel(Request $request)
    {
        try {
            $q = $request->q;
            $imoveis = Imovel::with(['user_aprovado'])
                ->where('aprovado', true)
                ->where('disponivel', true)
                ->where('observacao', 'like', '%' . $q . '%')
                ->orderBy('id', 'desc')
                ->get();
            return view('welcome', compact('imoveis', 'q'));

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
