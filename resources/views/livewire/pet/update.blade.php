<x-modal wire center>
    <div class="p-4 border-b">
        <h2 class="text-lg font-bold text-gray-800">Atualizar Pet</h2>
    </div>

    <form wire:submit="update">
        <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Nome do Pet</label>
                <input type="text" wire:model="nome" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('nome') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Espécie</label>
                <select wire:model="especie" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Selecione a Espécie...</option>
                    @foreach($this->especies as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
                @error('especie') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Raça <span class="text-gray-400 text-xs">(Opcional)</span></label>
                <select wire:model="raca" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Sem raça definida / Selecione...</option>
                    @foreach($this->racas as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
                @error('raca') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Sexo</label>
                <select wire:model="sexo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Selecione...</option>
                    <option value="macho">Macho</option>
                    <option value="femea">Fêmea</option>
                </select>
                @error('sexo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                <input type="date" wire:model="data_nascimento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"/>
                @error('data_nascimento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="flex justify-end gap-2 p-4 bg-gray-50 rounded-b-lg">
            <button type="button" wire:click="$set('modal', false)" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Cancelar
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center">
                <span>Atualizar Pet</span>
            </button>
        </div>
    </form>
</x-modal>