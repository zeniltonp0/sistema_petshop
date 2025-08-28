<div class="w-96 h-96 mt-4">
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
