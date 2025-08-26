<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\{Auth, Hash};
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Register extends Component
{
    public ?string $name = null;

    public ?string $email = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public function register()
    {
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
