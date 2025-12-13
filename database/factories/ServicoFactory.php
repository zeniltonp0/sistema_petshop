<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servico>
 */
class ServicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'            => fake()->randomElement(['Banho Completo', 'Tosa Higiênica', 'Tosa na Tesoura', 'Corte de Unhas', 'Hidratação', 'Day Care']),
            'descricao'       => fake()->sentence(),
            'preco'           => fake()->random_int(50, 200),
            'duracao_minutos' => fake()->randomElement([30, 60, 90, 120]),
            'ativo'           => true,
        ];
    }
}
