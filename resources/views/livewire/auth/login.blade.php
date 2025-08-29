<div class="mx-auto w-[450px]">
    <x-card>
        <h2 class="text-2xl text-center">Logar na conta</h2>
        <div class="flex justify-center">
            <livewire:images.logo />
        </div>

        <form wire:submit="login">
            @csrf
            <div class="mb-4">
                <x-input label="Email" wire:model.blur="email"/>
            </div>
            <div class="mb-4">
                <x-password label="Password" wire:model.blur="password" />
            </div>

            <div class="mx-86">
                <x-button submit>Login</x-button>
            </div>
        </form>
    </x-card>
</div>
