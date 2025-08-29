<div class="w-128 h-128 mt-4 grid grid-cols-2 space-x-2 space-y-2">
    @forelse ($this->pets as $pet)
        <div>
            <x-card image="{{ asset('storage/' . $pet->foto_pet) }}">
                <div class="p-4 flex flex-col">
                    <h2 class="text-xl font-bold text-gray-900">{{ $pet->nome }}</h2>

                    <div class="text-sm text-gray-600 mt-2 space-y-1">
                        <p><strong>Nascimento:</strong> {{ $pet->data_nascimento->format('d/m/Y') }}</p>
                        <p><strong>Espécie:</strong> {{ $pet->especie->value }}</p>
                        <p><strong>Raça:</strong> {{ $pet->raca->value }}</p>
                        <p><strong>Sexo:</strong> {{ $pet->sexo }}</p>
                    </div>
                </div>
            </x-card>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500">Você ainda não cadastrou nenhum pet.</p>
        </div>
    @endforelse
</div>
