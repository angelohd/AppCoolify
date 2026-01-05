<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contractos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('imovel_id');
            $table->unsignedBigInteger('inquilono');
            $table->unsignedBigInteger('mediador');
            $table->foreign('imovel_id')->references('id')->on('imovels')->onDelete('cascade');
            $table->foreign('inquilono')->nullable()->references('id')->on('users')->onDelete('cascade')->comment('Pessoa que aluga o imovel');
            $table->foreign('mediador')->nullable()->references('id')->on('users')->onDelete('cascade')->comment('Pessoa que faz a mediação do contrato');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->decimal('valor_mensal', 10, 2);
            $table->enum('status', ['ativo', 'encerrado', 'pendente'])->default('pendente');
            $table->decimal('valor_caucao', 10, 2)->nullable();
            $table->text('observacao')->nullable();
            $table->text('comprovativo_pagamento')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractos');
    }
};
