<?php

namespace App\Livewire\Pet;

use App\Models\Pet;
use Livewire\Attributes\{On, Validate};
use Livewire\Component;

class Update extends Component
{
    public ?int $petId = null;

    #[Validate('required|min:3')]
    public string $nome = '';

    // #[Validate('required')]
    // public string $especie = '';

    // public ?string $raca = null;

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
        $pet         = Pet::findOrFail($id);
        $this->petId = $pet->id;
        $this->nome  = $pet->nome;
        // $this->especie = $pet->especie;
        // $this->raca = $pet->raca;
        $this->sexo            = $pet->sexo;
        $this->data_nascimento = $pet->data_nascimento->format('Y-m-d');
    }

    public function update()
    {

        $this->validate();

        $pet = Pet::findOrFail($this->petId);

        $pet->update([
            'nome' => $this->nome,
            // 'especie' => $this->especie,
            // 'raca' => $this->raca,
            'sexo'            => $this->sexo,
            'data_nascimento' => $this->data_nascimento,
        ]);

        $this->modal = false;
        $this->dispatch('pets::refresh');
        $this->reset();

    }

    public function render()
    {
        return view('livewire.pet.update');
    }
}
