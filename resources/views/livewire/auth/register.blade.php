<div class="mx-auto w-[450px]">
    <x-card>
        <h2 class="text-2xl text-center">Criar conta</h2>
        <div class="flex justify-center">
            <livewire:images.logo />
        </div>

        <form wire:submit="register">
            @csrf
            <div class="mb-4">
                <x-input label="Nome" wire:model="name"/>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-input label="Email" wire:model="email"/>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-input label="Senha" wire:model="senha"/>
                @error('senha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-input label="Confirmação de senha" wire:model="password_confirmation"/>
                @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mx-80">
                <x-button submit>Registrar</x-button>
            </div>
        </form>
    </x-card>
</div>
