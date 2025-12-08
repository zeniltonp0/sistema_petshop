<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\{Auth, Hash};
use Livewire\Attributes\{Layout, Rule};
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Register extends Component
{
    #[Rule(['required', 'max:255', 'string', 'min:3'])]
    public ?string $name = null;

    #[Rule(['required', 'email', 'max:255', 'unique:users,email'])]
    #[Validate('unique:users,email', message: 'Não é possível realizar o login com este email e senha')]
    public ?string $email = null;

    #[Rule(['required', 'min:8', 'min:3', 'regex: /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'same:password_confirmation'])]
    public ?string $password = null;

    public ?string $password_confirmation = null;

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);

        return $this->redirect(route('welcome'));
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
