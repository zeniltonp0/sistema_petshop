<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect(route('login'));
    }
    public function render()
    {
        return view('livewire.sidebar');
    }
}
