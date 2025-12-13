<?php

namespace App\Livewire\Pet;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\{Computed, Layout, On};
use Livewire\Component;

#[Layout('components.layouts.app')]
class Pets extends Component
{
    public ?string $search = null;
    // public ?int $quantity = null;

    #[Computed]
    public function headers(): array
    {
        return [
            ['index' => 'id', 'label' => '#'],
            ['index' => 'nome', 'label' => 'Nome'],
            ['index' => 'especie.nome', 'label' => 'Espécie'],
            ['index' => 'raca.nome', 'label' => 'Raça'],
            ['index' => 'action'],
        ];
    }

    #[Computed]
    public function rows()
    {
        return Pet::query()
        ->where('user_id', '=', Auth::id())
        ->when($this->search, function (Builder $query) {
            return $query
            ->where('nome', 'like', "%{$this->search}%")
            ->orWhere('especie', 'like', "%{$this->search}%");
        })
                ->paginate(10)
                ->withQueryString();
    }

    public function create()
    {
        $this->dispatch('pets::create')->to('pet.create');
    }

    public function edit(int $id)
    {
        $this->dispatch('pets::edit', id: $id)->to('pet.update');
    }

    #[On('pets::refresh')]
    public function render()
    {
        return view('livewire.pet.pets');
    }
}
