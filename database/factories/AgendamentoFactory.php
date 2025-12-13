<?php

namespace Database\Factories;

use App\Models\{Pet, Servico};
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agendamento>
 */
class AgendamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $servico = Servico::inRandomOrder()->first() ?? Servico::factory()->create();

        $inicio = fake()->dateTimeBetween('-1 month', '+1 month');

        $fim = Carbon::instance($inicio)->addMinutes($servico->duracao_minutos);

        return [
            'pet_id' => Pet::factory(),

            'servico_id' => $servico->id,

            'data_hora_inicio' => $inicio,
            'data_hora_fim'    => $fim,

            'status'      => fake()->randomElement(['pendente', 'concluido', 'cancelado']),
            'observacoes' => fake()->optional()->sentence(),
        ];
    }
}
