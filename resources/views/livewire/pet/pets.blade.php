<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Meus Pets</h2>
        
        <x-button 
            text="Cadastrar novo Pet" 
            color="secondary" 
            icon="plus"
            loading 
            wire:click="$dispatch('pets::create')"
        />
    </div>

    @if($this->rows->isEmpty())
        <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
            <p class="text-gray-500 text-lg">Você ainda não tem pets cadastrados.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($this->rows as $pet)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden relative group border border-gray-100">
                    
                    <div class="absolute top-3 right-3 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <x-button.circle
                            color="white"
                            class="text-blue-500 shadow-sm hover:bg-blue-50"
                            icon="pencil"
                            md
                            wire:click="$dispatch('pets::edit', {id : '{{ $pet->id }}'})"
                        />
                    </div>

                    <div class="h-48 w-full bg-gray-100 flex items-center justify-center overflow-hidden">
                        @if($pet->foto_pet)
                            <img src="{{ asset('storage/' . $pet->foto_pet) }}" alt="{{ $pet->nome }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex flex-col items-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span class="text-sm">Sem foto</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $pet->nome }}</h3>
                                <p class="text-sm text-gray-500">{{ $pet->raca->nome ?? 'Raça não informada' }}</p>
                            </div>
                            @if($pet->sexo === 'macho')
                                <span class="bg-blue-100 text-blue-600 p-1.5 rounded-full" title="Macho">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> 
                                    ♂
                                </span>
                            @else
                                <span class="bg-pink-100 text-pink-600 p-1.5 rounded-full" title="Fêmea">
                                    ♀
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>
                                    {{ \Carbon\Carbon::parse($pet->data_nascimento)->age }} anos
                                </span>
                            </div>
                            <span class="px-2 py-1 bg-gray-100 rounded text-xs font-semibold uppercase tracking-wide">
                                {{ $pet->especie->nome ?? 'Espécie' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $this->rows->links() }}
        </div>
    @endif

    <livewire:pet.create />
    <livewire:pet.update />
</div>