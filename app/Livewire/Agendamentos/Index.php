<?php

namespace App\Livewire\Agendamentos;

use App\Models\Agendamento;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\{Component, WithPagination};
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use WithPagination;
    use Interactions;

    public function cancel($id)
    {
        $appointment = Agendamento::whereHas('pet', function ($query) {
            $query->where('user_id', Auth::id());
        })->findOrFail($id);

        if ($appointment->status !== 'concluido') {
            $appointment->update(['status' => 'cancelado']);

            $this->toast()->success('Cancelamento realizado com sucesso!')->send();
        }
    }

    #[Computed]
    public function proximos()
    {
        return Agendamento::with(['pet', 'servico'])
            ->whereHas('pet', fn ($q) => $q->where('user_id', Auth::id()))
            ->where('data_hora_inicio', '>=', now())
            ->whereIn('status', ['pendente', 'confirmado'])
            ->orderBy('data_hora_inicio', 'asc')
            ->get();
    }

    #[Computed]
    public function historico()
    {
        return Agendamento::with(['pet', 'servico'])
            ->whereHas('pet', fn ($q) => $q->where('user_id', Auth::id()))
            ->where(function ($query) {
                $query->where('data_hora_inicio', '<', now())
                      ->orWhere('status', 'cancelado')
                      ->orWhere('status', 'concluido');
            })
            ->orderBy('data_hora_inicio', 'desc')
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.agendamentos.index');
    }
}
