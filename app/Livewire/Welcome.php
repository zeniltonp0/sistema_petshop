<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\{Computed, Layout};
use Livewire\Component;

#[Layout('components.layouts.app')]
class Welcome extends Component
{
    #[Computed]
    public function userName()
    {
        return Auth::user()->name;
    }
    public function render()
    {
        return view('livewire.welcome');
    }
}
