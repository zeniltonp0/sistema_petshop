<?php

namespace App\Livewire\Agendamentos;

use App\Models\{Agendamento, Pet, Servico};
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\{Computed};
use Livewire\Component;

class Create extends Component
{
    public int $step = 1;

    public $search = '';

    public $pet_id = null;

    public ?Pet $selectedPet = null;

    public $servico_id = '';

    public $data_hora = '';

    public $observacoes = '';

    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->resetPet();
        }
    }

    public function selectPet($id)
    {
        $this->selectedPet = Pet::find($id);

        if ($this->selectedPet) {
            $this->pet_id = $this->selectedPet->id;
            $this->search = $this->selectedPet->nome;
            $this->resetValidation('pet_id');
        }
    }

    public function selectFirstMatch()
    {
        $first = $this->searchResults->first(); // @phpstan-ignore-line

        if ($first) {
            $this->selectPet($first->id);
        }
    }

    public function resetPet()
    {
        $this->selectedPet = null;
        $this->pet_id      = null;
    }

    #[Computed]
    public function searchResults()
    {
        if (strlen($this->search) < 2) {
            return [];
        }

        return Pet::where('user_id', Auth::id())
            ->where('nome', 'like', '%' . $this->search . '%')
            ->limit(5)
            ->get();
    }

    #[Computed]
    public function servicos()
    {
        return \App\Models\Servico::where('ativo', true)->get(); // Ajuste o Model se necessário
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'pet_id' => 'required|exists:pets,id',
            ], ['pet_id.required' => 'Por favor, selecione um pet da lista.']);
        }

        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function save()
    {
        $this->validate([
            'servico_id'  => 'required',
            'data_hora'   => 'required|date|after:now',
            'observacoes' => 'nullable|string|max:500',
        ]);

        $servico = Servico::find($this->servico_id);
        $inicio  = Carbon::parse($this->data_hora);
        $fim     = $inicio->copy()->addMinutes($servico->duracao_minutos);

        $conflito = Agendamento::where('pet_id', $this->pet_id)
            ->where('status', '!=', 'cancelado')
            ->where(function ($query) use ($inicio, $fim) {
                $query->whereBetween('data_hora_inicio', [$inicio, $fim])
                      ->orWhereBetween('data_hora_fim', [$inicio, $fim])
                      ->orWhere(function ($q) use ($inicio, $fim) {
                          $q->where('data_hora_inicio', '<', $inicio)
                            ->where('data_hora_fim', '>', $fim);
                      });
            })->exists();

        if ($conflito) {
            $this->addError('data_hora', 'Este pet já tem um agendamento conflitante neste horário.');

            return;
        }

        Agendamento::create([
            'pet_id'           => $this->pet_id,
            'servico_id'       => $this->servico_id,
            'data_hora_inicio' => $inicio,
            'data_hora_fim'    => $fim,
            'status'           => 'pendente',
            'observacoes'      => $this->observacoes,
        ]);

        session()->flash('success', 'Agendamento realizado com sucesso!');

        return redirect()->route('agendamentos.index');
    }

    public function render()
    {
        return view('livewire.agendamentos.create');
    }
}
