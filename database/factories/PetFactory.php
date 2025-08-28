<?php

namespace Database\Factories;

use App\Enums\{EspecieEnum, RacaEnum};
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class PetFactory extends Factory
{
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
            'foto_pet'        => $this->getFotoLocal($especie),
        ];
    }

    private function getFotoLocal(EspecieEnum $especie): ?string
    {
        $folder = match ($especie) {
            EspecieEnum::CACHORRO => 'pets/cachorros',
            EspecieEnum::GATO     => 'pets/gatos',
            default               => null,
        };

        if (!$folder) {
            return null;
        }

        $files = Storage::disk('public')->files($folder);

        if (empty($files)) {
            return null;
        }

        return fake()->randomElement($files);
    }
}
