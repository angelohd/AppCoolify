<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use SoftDeletes;
    protected $table = 'pessoas';
    protected $fillable = ['nome','numero_identidade','telefone'];
}
