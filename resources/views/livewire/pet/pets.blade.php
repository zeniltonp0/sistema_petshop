<div class="w-128 h-128 mt-4 grid grid-cols-2 space-x-2 space-y-2">
    @forelse ($this->pets as $pet)
        <div>
            <x-card image="{{ $pet->foto_url }}">
                <span>{{ $pet->nome }}</span>
                <span>{{ $pet->data_nascimento->format('d/m/Y') }}</span>
                
                <span>{{ $pet->especie->value }}</span>
                <span>{{ $pet->raca->value }}</span>
                
                <span>{{ $pet->sexo }}</span>
            </x-card>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500">Você ainda não cadastrou nenhum pet.</p>
        </div>
    @endforelse
</div>
