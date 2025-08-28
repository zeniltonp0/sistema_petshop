<div class="w-96 h-96 mt-4">
    @foreach ($this->pets as $pet)
        <div>
            <x-card image="{{ $pet->foto_pet }}">
                <span>{{ $pet->nome }}</span>
                <span>{{ $pet->data_nascimento }}</span>
                <span>{{ $pet->especie }}</span>
                <span>{{ $pet->raca }}</span>
                <span>{{ $pet->sexo }}</span>
            </x-card>
        </div>
    @endforeach
</div>
