<?php

namespace Database\Factories;

use App\Enums\{EspecieEnum, RacaEnum};
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $especie = fake()->randomElement(EspecieEnum::cases());
        $raca    = fake()->randomElement(RacaEnum::fromEspecie($especie));

        return [
            'user_id'         => User::factory(),
            'nome'            => fake()->firstName(),
            'especie'         => $especie,
            'raca'            => $raca,
            'data_nascimento' => fake()->dateTimeBetween('-10 years', 'now'),
        ];
    }
}
