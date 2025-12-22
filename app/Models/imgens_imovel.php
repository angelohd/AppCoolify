<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class imgens_imovel extends Model
{
    protected $table = 'imgens_imovels';
    protected $fillable = ['imovel_id','caminho_imagem'];
}
