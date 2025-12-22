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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imovel_id')->constrained('imovels')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('visitante')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate()->comment('Pessoa que vai vizitar a casa');
            $table->date('data_visita');
            $table->enum('status', ['pendente', 'cancelado', 'em_curso', 'concluido'])->default('pendente');
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
        Schema::dropIfExists('visitas');
    }
};
