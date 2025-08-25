<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Register extends Component
{
    public ?string $nome = null;

    public ?string $email = null;

    public ?string $senha = null;

    public function register()
    {
        $user = User::create([
            'name'     => $this->nome,
            'email'    => $this->email,
            'password' => $this->senha,
        ]);

        Auth::login($user);

        return $this->redirect(route('welcome'));
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
