<?php

namespace Database\Factories;

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
        $especies = ['Cachorro', 'Gato', 'Pássaro', 'Hamster'];
        $racas    = ['Golden Retriever', 'Siamês', 'Labrador', 'Persa', 'Canário', 'Sírio'];

        return [
            'user_id'         => User::factory(),
            'nome'            => fake()->firstName(),
            'foto_pet'        => fake()->imageUrl(),
            'especie'         => fake()->randomElement($especies),
            'raca'            => fake()->randomElement($racas),
            'data_nascimento' => fake()->dateTimeBetween('-10 years', 'now'),
        ];
    }
}
