<x-modal wire center>
    <div class="p-4 border-b bg-gray-50 rounded-t-lg flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-800">Atualizar Pet</h2>
        <button wire:click="$set('modal', false)" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <form wire:submit="update">
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="col-span-1 md:col-span-2 flex flex-col items-center justify-center mb-2">
                <div class="relative group">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg bg-gray-100">
                        @if ($foto) 
                            <img src="{{ $foto->temporaryUrl() }}" class="w-full h-full object-cover">
                        @elseif ($foto_atual)
                            <img src="{{ asset('storage/' . $foto_atual) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <label for="foto-upload" class="absolute bottom-1 right-1 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full shadow-md cursor-pointer transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        
                        <input id="foto-upload" type="file" wire:model="foto" accept="image/png, image/jpeg, image/jpg" class="hidden">
                    </label>
                </div>
                
                <div class="mt-2 h-5 text-center">
                    <span wire:loading wire:target="foto" class="text-xs text-blue-600 font-semibold animate-pulse">
                        Carregando imagem...
                    </span>
                    @error('foto') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Pet</label>
                <input type="text" wire:model="nome" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                @error('nome') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Espécie</label>
                <select wire:model="especie" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                    <option value="">Selecione a Espécie...</option>
                    @foreach($this->especies as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
                @error('especie') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Raça <span class="text-gray-400 text-xs font-normal ml-1">(Opcional)</span></label>
                <select wire:model="raca" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                    <option value="">Sem raça definida / Selecione...</option>
                    @foreach($this->racas as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
                @error('raca') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sexo</label>
                <select wire:model="sexo" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150">
                    <option value="">Selecione...</option>
                    <option value="macho">Macho</option>
                    <option value="femea">Fêmea</option>
                </select>
                @error('sexo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                <input type="date" wire:model="data_nascimento" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150"/>
                @error('data_nascimento') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="flex justify-end gap-3 p-4 bg-gray-50 rounded-b-lg border-t">
            <button type="button" wire:click="$set('modal', false)" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                Cancelar
            </button>
            <button type="submit" wire:loading.attr="disabled" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors flex items-center">
                <svg wire:loading wire:target="foto, update" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Salvar Alterações</span>
            </button>
        </div>
    </form>
</x-modal>