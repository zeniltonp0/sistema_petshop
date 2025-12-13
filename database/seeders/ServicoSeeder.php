<?php

namespace Database\Seeders;

use App\Models\Servico;
use Illuminate\Database\Seeder;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicos = [
            ['nome' => 'Banho Simples', 'preco' => 45.00, 'duracao_minutos' => 45],
            ['nome' => 'Banho e Tosa', 'preco' => 80.00, 'duracao_minutos' => 90],
            ['nome' => 'Tosa Higiênica', 'preco' => 30.00, 'duracao_minutos' => 30],
            ['nome' => 'Corte de Unhas', 'preco' => 15.00, 'duracao_minutos' => 15],
            ['nome' => 'Hidratação Profunda', 'preco' => 60.00, 'duracao_minutos' => 45],
            ['nome' => 'Consulta Veterinária', 'preco' => 150.00, 'duracao_minutos' => 60],
        ];

        foreach ($servicos as $servico) {
            Servico::create($servico);
        }
    }
}
