<?php

use App\Models\{Especie, Raca, User};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained('users', 'id')->onDelete('cascade');
            $table->foreignIdFor(Raca::class, 'raca_id');
            $table->foreignIdFor(Especie::class, 'especie_id');
            $table->string('nome');
            $table->enum('sexo', ['macho', 'femea']);
            $table->date('data_nascimento')->nullable();
            $table->string('foto_pet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
