<?php

use App\Models\{Pet, Servico};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pet::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Servico::class)->constrained();
            $table->dateTime('data_hora_inicio');
            $table->dateTime('data_hora_fim');
            $table->enum('status', ['pendente', 'concluido', 'cancelado'])->default('pendente');
            $table->text('observacoes')->nullable();
            $table->index(['pet_id', 'data_hora_inicio', 'data_hora_fim']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
