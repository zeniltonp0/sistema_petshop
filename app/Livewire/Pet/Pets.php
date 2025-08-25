<?php

namespace App\Livewire\Pet;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Pets extends Component
{
    public function render()
    {
        return view('livewire.pet.pets');
    }
}
