<?php

use App\Models\{Pet, User};
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
            $table->foreignIdFor(User::class)->constrained('users', 'id')->onDelete('cascade');
            $table->foreignIdFor(Pet::class)->constrained('pets', 'id')->onDelete('cascade');
            $table->enum('tipo_servico', ['banho', 'tosa', 'consulta']);
            $table->dateTime('horario');
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
