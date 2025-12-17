<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900">Novo Agendamento</h1>
        <p class="mt-2 text-sm text-gray-600">Vamos marcar um momento especial para seu amiguinho.</p>
    </div>

    <div class="mb-8">
        <div class="flex items-center justify-between relative">
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 -z-10"></div>
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-1 bg-blue-600 transition-all duration-300 -z-10" style="width: {{ $step === 1 ? '50%' : '100%' }}"></div>
            
            <div class="flex flex-col items-center bg-white px-2 py-2">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold border-2 transition-colors duration-300 {{ $step >= 1 ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-gray-300 text-gray-500' }}">
                    1
                </div>
                <span class="text-xs font-semibold mt-2 {{ $step >= 1 ? 'text-blue-600' : 'text-gray-500' }}">Selecionar Pet</span>
            </div>

            <div class="flex flex-col items-center bg-white px-2 py-2">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold border-2 transition-colors duration-300 {{ $step >= 2 ? 'bg-blue-600 border-blue-600 text-white' : 'bg-white border-gray-300 text-gray-500' }}">
                    2
                </div>
                <span class="text-xs font-semibold mt-2 {{ $step >= 2 ? 'text-blue-600' : 'text-gray-500' }}">Detalhes</span>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        
        @if($step === 1)
            <div class="p-8 animate-fade-in-right">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Qual pet será atendido?</h2>

                <div class="relative max-w-lg mx-auto">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Busque pelo nome do Pet</label>
                    
                    <div class="relative">
                        <input 
                            type="text" 
                            wire:model.live.debounce.300ms="search"
                            wire:keydown.enter.prevent="selectFirstMatch"
                            placeholder="Ex: Rex, Mel..." 
                            class="w-full pl-12 pr-4 py-4 rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-lg transition-all"
                            autocomplete="off"
                        >
                        <div class="absolute left-4 top-4 text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>

                    @if(!empty($this->searchResults) && !$selectedPet)
                        <div class="absolute z-10 w-full mt-2 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden divide-y divide-gray-100">
                            @foreach($this->searchResults as $pet)
                                <button 
                                    wire:click="selectPet({{ $pet->id }})"
                                    class="w-full text-left px-4 py-3 hover:bg-blue-50 transition-colors flex items-center gap-3 group"
                                >
                                    <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden flex-shrink-0">
                                        @if($pet->foto_pet)
                                            <img src="{{ asset('storage/'.$pet->foto_pet) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 group-hover:text-blue-700">{{ $pet->nome }}</p>
                                        <p class="text-xs text-gray-500">{{ $pet->raca->nome ?? 'Raça indefinida' }}</p>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @endif

                    @error('pet_id') <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span> @enderror
                </div>

                @if($selectedPet)
                    <div class="mt-8 p-6 bg-blue-50 border border-blue-100 rounded-xl flex items-center gap-6 animate-pulse-once">
                        <div class="w-24 h-24 rounded-full bg-white shadow-md overflow-hidden border-4 border-white flex-shrink-0">
                            @if($selectedPet->foto_pet)
                                <img src="{{ asset('storage/'.$selectedPet->foto_pet) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-100">
                                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-800">{{ $selectedPet->nome }}</h3>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="px-2 py-1 bg-white rounded text-xs font-semibold text-gray-600 border border-gray-200">{{ $selectedPet->especie->nome ?? 'Espécie' }}</span>
                                <span class="px-2 py-1 bg-white rounded text-xs font-semibold text-gray-600 border border-gray-200">{{ $selectedPet->raca->nome ?? 'SRD' }}</span>
                                <span class="px-2 py-1 {{ $selectedPet->sexo == 'macho' ? 'bg-blue-100 text-blue-600' : 'bg-pink-100 text-pink-600' }} rounded text-xs font-semibold capitalize">
                                    {{ $selectedPet->sexo }}
                                </span>
                            </div>
                        </div>
                        <button wire:click="resetPet" class="text-gray-400 hover:text-red-500 transition-colors" title="Trocar Pet">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif
            </div>
        @endif

        @if($step === 2)
            <div class="p-8 animate-fade-in-right">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Detalhes do Agendamento</h2>
                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Pet: <strong>{{ $selectedPet->nome }}</strong></span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Serviço Desejado</label>
                        <select wire:model.live="servico_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3">
                            <option value="">Selecione...</option>
                            @foreach($this->servicos as $servico)
                                <option value="{{ $servico->id }}">
                                    {{ $servico->nome }} ({{ $servico->duracao_minutos }} min) - R$ {{ number_format($servico->preco, 2, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('servico_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Data e Hora de Início</label>
                        <input type="datetime-local" wire:model.blur="data_hora" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2.5">
                        @error('data_hora') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Observações Extras <span class="text-gray-400 text-xs font-normal">(Opcional)</span></label>
                        <textarea wire:model="observacoes" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Ex: Cuidado, ele tem medo de secador..."></textarea>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-gray-50 px-8 py-5 flex justify-between items-center border-t border-gray-100">
            @if($step > 1)
                <button wire:click="prevStep" class="text-gray-600 font-medium hover:text-gray-900 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Voltar
                </button>
            @else
                <div></div> @endif

            @if($step < 2)
                <button wire:click="nextStep" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-blue-700 shadow-md hover:shadow-lg transition-all flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed" @if(!$selectedPet) disabled @endif>
                    Próximo Passo
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            @else
                <button wire:click="save" wire:loading.attr="disabled" class="bg-green-600 text-white px-8 py-2.5 rounded-lg font-medium hover:bg-green-700 shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <span wire:loading.remove wire:target="save">Confirmar Agendamento</span>
                    <span wire:loading wire:target="save">Salvando...</span>
                </button>
            @endif
        </div>
    </div>
</div>