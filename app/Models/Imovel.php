<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imovel extends Model
{
    use SoftDeletes;
    protected $table = 'imovels';
    protected $fillable = [
        'endereco',
        'zona',
        'descricao',
        'preco_renda',
        'disponivel',
        'user_id',
        'observacao',
        'aprovado',
        'aprovado_por',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function user_aprovado(){
        return $this->hasOne(User::class, 'id', 'aprovado_por');
    }

    public function imagens(){
        return $this->hasMany(imgens_imovel::class,'imovel_id','id');
    }
}
