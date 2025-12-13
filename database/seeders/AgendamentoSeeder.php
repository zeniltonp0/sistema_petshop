<?php

namespace Database\Seeders;

use App\Models\{Agendamento, Pet};
use Illuminate\Database\Seeder;

class AgendamentoSeeder extends Seeder
{
    public function run(): void
    {
        if (Pet::count() === 0) {
            Pet::factory(10)->create();
        }

        Agendamento::factory(50)->recycle(Pet::all())->create();
    }
}
