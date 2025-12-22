<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contracto extends Model
{
    use SoftDeletes;
    protected $table = 'contractos';
    protected $fillable = ['imovel_id','inquilono','mediador','data_inicio','data_fim','valor_mensal','status','valor_caucao'];
}
