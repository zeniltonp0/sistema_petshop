<?php

namespace App\Livewire\Pet;

use App\Models\{Especie, Pet, Raca};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage; // <--- Importante adicionar isso
use Livewire\Attributes\{Computed, On, Validate};
use Livewire\{Component, WithFileUploads};

class Update extends Component
{
    use WithFileUploads;

    public ?int $petId = null;

    #[Validate('required|min:3')]
    public string $nome = '';

    #[Validate('required')]
    public ?string $especie = null;

    #[Validate('nullable|image|max:2048')]
    public $foto;

    public ?string $foto_atual = null;

    public ?string $raca = null;

    public string $sexo = '';

    public string $data_nascimento = '';

    public bool $modal = false;

    #[On('pets::edit')]
    public function open(int $id)
    {
        $this->modal = true;
        $this->reset('foto');
        $this->loadPet($id);
    }

    public function loadPet(int $id)
    {
        $pet = Pet::findOrFail($id);

        $this->petId = $pet->id;
        $this->nome  = $pet->nome;

        $this->foto_atual = $pet->foto_pet;

        $this->especie         = (string) $pet->especie_id;
        $this->raca            = (string) $pet->raca_id;
        $this->sexo            = $pet->sexo;
        $this->data_nascimento = $pet->data_nascimento ? $pet->data_nascimento->format('Y-m-d') : '';
    }

    public function update()
    {
        $this->validate();

        $pet = Pet::findOrFail($this->petId);

        $dados = [
            'nome'            => $this->nome,
            'especie_id'      => $this->especie,
            'raca_id'         => $this->raca ?: null,
            'sexo'            => $this->sexo,
            'data_nascimento' => $this->data_nascimento,
        ];

        if ($this->foto) {
            if ($pet->foto_pet && Storage::disk('public')->exists($pet->foto_pet)) {
                Storage::disk('public')->delete($pet->foto_pet);
            }

            $dados['foto_pet'] = $this->foto->store('pets', 'public');
        }

        $pet->update($dados);

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
