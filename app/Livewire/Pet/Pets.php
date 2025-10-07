<?php

namespace App\Livewire\Pet;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\{Computed, Layout};
use Livewire\Component;

#[Layout('components.layouts.app')]
class Pets extends Component
{
    public ?string $search = null;

    #[Computed]
    public function headers(): array
    {
        return [
            ['index' => 'id', 'label' => '#'],
            ['index' => 'nome', 'label' => 'Nome'],
            ['index' => 'especie', 'label' => 'Espécie'],
        ];
    }

    #[Computed]
    public function rows()
    {
        return Pet::query()
        ->when($this->search, function (Builder $query) {
            return $query
            ->where('nome', 'like', "%{$this->search}%")
            ->orWhere('especie', 'like', "%{$this->search}%");
        })
                ->paginate(2)
                ->withQueryString();
    }
    public function render()
    {
        return view('livewire.pet.pets');
    }
}
