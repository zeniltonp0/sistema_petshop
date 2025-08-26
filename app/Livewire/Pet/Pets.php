<?php

namespace App\Livewire\Pet;

use Livewire\Attributes\{Computed, Layout};
use Livewire\Component;

#[Layout('components.layouts.app')]
class Pets extends Component
{
    #[Computed]
    public function pets()
    {
        return auth()->user()->pets;
    }
    public function render()
    {
        return view('livewire.pet.pets');
    }
}
