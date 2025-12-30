<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $table = 'visitas';
    protected $fillable = ['imovel_id', 'visitante', 'data_visita', 'status'];

    public function imovel()
    {
        return $this->hasOne(Imovel::class, 'id', 'imovel_id');
    }

    public function getvisitante()
    {
        return $this->hasOne(User::class, 'id', 'visitante');
    }
}
