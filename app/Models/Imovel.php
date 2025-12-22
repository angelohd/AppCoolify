<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    protected $table = 'imovels';
    protected $fillable = ['endereco','sona','descricao','preco_renda','disponivel','user_id'];
}
