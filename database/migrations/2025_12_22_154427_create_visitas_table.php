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
            $table->unsignedBigInteger('imovel_id');
            $table->unsignedBigInteger('visitante');
            $table->foreign('imovel_id')->references('id')->on('imovels')->onDelete('cascade');
            $table->foreign('visitante')->references('id')->on('users')->onDelete('cascade')->comment('Pessoa que vai vizitar a casa');
            $table->date('data_visita');
            $table->enum('status', ['pendente', 'cancelado','confirmada', 'em_curso', 'concluido'])->default('pendente');
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
