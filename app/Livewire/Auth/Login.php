<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    public ?string $email = null;

    public ?string $password = null;

    public function login()
    {
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();

            return $this->redirect(route('welcome'));
        }

        session()->flash('error', 'Credenciais inválidas. Tente novamente');
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
