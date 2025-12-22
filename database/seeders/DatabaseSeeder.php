<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Pessoa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categorias = [
            ['categoria' => 'Administrador'],
            ['categoria' => 'Mediador'],
            ['categoria' => 'Usuario comum'],
        ];
        Categoria::insert($categorias);
        Pessoa::create([
            'nome' => 'Admin',
            'numero_identidade' => '0000000000',
            'telefone' => '0000000000'
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@sistema.com',
            'password' => Hash::make('password'),
            'categoria_id' => 1,
            'pessoa_id' => 1,
        ]);
    }
}
