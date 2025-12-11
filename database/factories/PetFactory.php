<?php

namespace Database\Factories;

use App\Models\{Especie, Raca, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    public function definition(): array
    {

        return [
            'user_id'         => User::factory(),
            'nome'            => fake()->firstName(),
            'especie_id'      => Especie::factory(),
            'raca_id'         => Raca::factory(),
            'data_nascimento' => fake()->dateTimeBetween('-10 years', 'now'),
            // 'foto_pet'        => $this->getFotoLocal($especie),
        ];
    }

    // private function getFotoLocal(EspecieEnum $especie): ?string
    // {
    //     $folder = match ($especie) {
    //         EspecieEnum::CACHORRO => 'pets/cachorros',
    //         EspecieEnum::GATO     => 'pets/gatos',
    //         default               => null,
    //     };

    //     if (!$folder) {
    //         return null;
    //     }

    //     $files = Storage::disk('public')->files($folder);

    //     if (empty($files)) {
    //         return null;
    //     }

    //     return fake()->randomElement($files);
    // }
}
