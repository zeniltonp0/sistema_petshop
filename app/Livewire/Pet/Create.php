<?php

namespace App\Livewire\Pet;

use App\Models\{Especie, Pet, Raca};
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\{Computed, On, Validate};
use Livewire\{Component, WithFileUploads};
// 1. Importar Trait de Upload
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Interactions;
    use WithFileUploads;

    #[Validate(['required', 'string', 'min:2'])]
    public ?string $nome = null;

    #[Validate(['required', 'exists:especies,id'])]
    public ?string $especie = null;

    #[Validate(['nullable', 'exists:racas,id'])]
    public ?string $raca = null;

    #[Validate(['required', 'string', 'in:macho,femea'])]
    public ?string $sexo = null;

    #[Validate(['required', 'date'])]
    public ?string $data_nascimento = null;

    #[Validate(['nullable', 'image', 'max:2048'])]
    public $foto;

    public bool $modal = false;

    #[On('pets::create')]
    public function open()
    {
        $this->reset();
        $this->modal = true;
    }

    public function save()
    {
        $this->validate();

        $dados = [
            'user_id'         => Auth::id(),
            'nome'            => $this->nome,
            'especie_id'      => $this->especie,
            'raca_id'         => $this->raca ?: null,
            'sexo'            => $this->sexo,
            'data_nascimento' => $this->data_nascimento,
        ];

        if ($this->foto) {
            $dados['foto_pet'] = $this->foto->store('pets', 'public');
        }

        Pet::create($dados);

        $this->modal = false;

        $this->toast()->success('Sucesso!', 'Seu amiguinho(a) foi cadastrado!')->send();

        $this->dispatch('pets::refresh');

        $this->reset();
    }

    // Carregar as opções para o Select
    #[Computed]
    public function especies()
    {
        return Especie::orderBy('nome')->get();
    }

    #[Computed]
    public function racas()
    {
        return Raca::orderBy('nome')->get();
    }

    public function render()
    {
        return view('livewire.pet.create');
    }
}
