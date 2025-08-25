<div class="mx-auto w-[450px]">
    <x-card>
        <h2 class="text-2xl text-center">Criar conta</h2>
        <div class="flex justify-center">
            <livewire:images.logo />
        </div>

        <form wire:submit="register">
            <div class="mb-4">
                <x-input label="Nome" />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-input label="Email" />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-input label="Senha" />
                @error('senha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mx-80">
                <x-button submit>Registrar</x-button>
            </div>
        </form>
    </x-card>
</div>
