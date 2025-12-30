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
        Schema::create('imovels', function (Blueprint $table) {
            $table->id();
            $table->text('endereco');
            $table->enum('zona', ['Urbana', 'Suburbana']);
            $table->text('descricao')->nullable();
            $table->decimal('preco_renda', 10, 2);
            $table->boolean('disponivel')->default(false);
            $table->boolean('aprovado')->default(false);
            $table->text('observacao');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('aprovado_por')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('aprovado_por')->references('id')->on('users')->onDelete('cascade')->comment('Utilizador que aprovou a casa');
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
        Schema::dropIfExists('imovels');
    }
};
