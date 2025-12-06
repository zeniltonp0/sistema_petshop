<?php

namespace App\Livewire\Pet;

use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\{On, Validate};
use Livewire\Component;

class Create extends Component
{
    #[Validate(['required', 'string'])]
    public ?string $nome = null;

    #[Validate(['required', 'string', 'max:50'])]
    public ?string $especie = null;

    #[Validate(['required', 'string', 'max:50'])]
    public ?string $raca = null;

    #[Validate(['required', 'string', 'in:macho,femea'])]
    public ?string $sexo = null;

    #[Validate(['required', 'date'])]
    public ?string $data_nascimento = null;

    public bool $modal = false;

    #[On('pets::create')]
    public function open()
    {
        $this->modal = true;
    }

    public function save()
    {
        $this->validate();

        Pet::create([
            'user_id'         => Auth::id(),
            'nome'            => $this->nome,
            'especie'         => $this->especie,
            'raca'            => $this->raca,
            'sexo'            => $this->sexo,
            'data_nascimento' => $this->data_nascimento,
        ]);

        $this->modal = false;
        // $this->reset();
    }

    public function render()
    {
        return view('livewire.pet.create');
    }
}
