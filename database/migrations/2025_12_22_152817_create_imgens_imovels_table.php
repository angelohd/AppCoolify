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
        Schema::create('imgens_imovels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imovel_id')->nullable()->constrained('imovels')->nullOnDelete()->cascadeOnUpdate();
            $table->string('caminho_imagem');
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
        Schema::dropIfExists('imgens_imovels');
    }
};
