<?php

namespace App\Livewire\Pet;

use App\Models\{Especie, Pet, Raca};
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\{Computed, On, Validate};
use Livewire\Component;

class Update extends Component
{
    public ?int $petId = null;

    #[Validate('required|min:3')]
    public string $nome = '';

    #[Validate('required')]
    public ?string $especie = null;

    public ?string $raca = null;

    public string $sexo = '';

    public string $data_nascimento = '';

    public bool $modal = false;

    #[On('pets::edit')]
    public function open(int $id)
    {
        $this->modal = true;
        $this->loadPet($id);
    }

    public function loadPet(int $id)
    {
        $pet                   = Pet::findOrFail($id);
        $this->petId           = $pet->id;
        $this->nome            = $pet->nome;
        $this->especie         = $pet->especie_id; // @phpstan-ignore-line
        $this->raca            = $pet->raca_id; // @phpstan-ignore-line
        $this->sexo            = $pet->sexo;
        $this->data_nascimento = $pet->data_nascimento->format('Y-m-d');
        // dd($pet);
    }

    public function update()
    {
        // dd($this->all());

        $this->validate();

        $pet = Pet::findOrFail($this->petId);

        $pet->update([
            'nome'            => $this->nome,
            'especie_id'      => $this->especie,
            'raca_id'         => $this->raca ?: null,
            'sexo'            => $this->sexo,
            'data_nascimento' => $this->data_nascimento,
        ]);

        $this->modal = false;
        $this->dispatch('pets::refresh');
        $this->reset();

    }

    #[Computed]
    public function especies(): Collection
    {
        return Especie::query()->orderBy('nome')->get();
    }

    #[Computed]
    public function racas(): Collection
    {
        return Raca::query()->orderBy('nome')->get();
    }

    public function render()
    {
        return view('livewire.pet.update');
    }
}
