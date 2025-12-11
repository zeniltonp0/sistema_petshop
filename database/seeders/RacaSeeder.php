<?php

namespace Database\Seeders;

use App\Models\Raca;
use Illuminate\Database\Seeder;

class RacaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Raca::factory()->count(5);
    }
}
