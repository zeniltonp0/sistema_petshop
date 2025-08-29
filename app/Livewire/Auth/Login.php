<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\{Layout, Rule, Validate};
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    #[Rule(['required', 'email', 'max:255', 'unique:users,email'])]
    #[Validate('unique', message: 'Não foi possível realizar o login com este email e senha')]
    public ?string $email = null;

    #[Rule(['required', 'max:8', 'min:3', 'regex: /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'])]
    public ?string $password = null;

    public function login()
    {
        $this->validate();

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
