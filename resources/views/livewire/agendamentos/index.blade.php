<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">
    
    <div class="flex flex-col sm:flex-row justify-between items-end sm:items-center gap-4 border-b border-gray-200 pb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Agendamentos</h1>
            <p class="text-gray-500 mt-1">Gerencie os cuidados dos seus amiguinhos.</p>
        </div>
        <x-button 
            text="Novo Agendamento" 
            icon="calendar" 
            color="primary" 
            wire:click="$dispatch('agendamento::create')"
        />
    </div>

    <section>
        <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Próximos Cuidados
        </h2>

        @if($this->proximos->isEmpty())
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-8 text-center">
                <p class="text-blue-800 font-medium">Nenhum agendamento futuro.</p>
                <p class="text-blue-600 text-sm mt-1">Que tal marcar um banho ou tosa para seu pet ficar lindão?</p>
            </div>
        @else
            <div class="grid gap-4">
                @foreach($this->proximos as $agenda)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200 flex flex-col sm:flex-row items-start sm:items-center gap-6 relative overflow-hidden group">
                        
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $agenda->status === 'confirmado' ? 'bg-green-500' : 'bg-yellow-400' }}"></div>

                        <div class="flex flex-col items-center justify-center bg-gray-50 rounded-lg p-3 min-w-[80px] border border-gray-200 ml-2">
                            <span class="text-xs font-bold text-gray-500 uppercase">{{ $agenda->data_hora_inicio }}</span>
                            <span class="text-2xl font-extrabold text-gray-800">{{ $agenda->data_hora_inicio }}</span>
                            <span class="text-xs font-medium text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full mt-1">
                                {{ $agenda->data_hora_inicio }}
                            </span>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-1">
                                <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden border border-gray-300">
                                    @if($agenda->pet->foto_pet)
                                        <img src="{{ asset('storage/' . $agenda->pet->foto_pet) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </div>
                                    @endif
                                </div>
                                <span class="text-sm text-gray-500 font-medium">Para: <strong class="text-gray-700">{{ $agenda->pet->nome }}</strong></span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800">{{ $agenda->servico->nome }}</h3>
                            <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $agenda->servico->duracao_minutos }} min
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    R$ {{ number_format($agenda->servico->preco, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-col items-end gap-3 min-w-[120px]">
                            @if($agenda->status === 'confirmado')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Confirmado
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                    Aguardando
                                </span>
                            @endif

                            <button 
                                wire:confirm="Tem certeza que deseja cancelar este agendamento?"
                                wire:click="cancel({{ $agenda->id }})"
                                class="text-sm text-red-500 hover:text-red-700 hover:underline opacity-100 sm:opacity-0 group-hover:opacity-100 transition-opacity"
                            >
                                Cancelar agendamento
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <section class="opacity-75 hover:opacity-100 transition-opacity duration-300">
        <h2 class="text-lg font-semibold text-gray-500 mb-4 flex items-center gap-2 border-t border-gray-200 pt-8">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Histórico Recente
        </h2>

        @if($this->historico->isEmpty())
            <p class="text-gray-400 italic text-sm">Nenhum histórico disponível.</p>
        @else
            <div class="space-y-3">
                @foreach($this->historico as $antigo)
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between border border-gray-100">
                        <div class="flex items-center gap-4">
                            @if($antigo->status == 'cancelado')
                                <div class="bg-red-100 p-2 rounded-full text-red-500">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </div>
                            @else
                                <div class="bg-gray-200 p-2 rounded-full text-gray-500">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            @endif

                            <div>
                                <h4 class="font-bold text-gray-600 {{ $antigo->status == 'cancelado' ? 'line-through' : '' }}">
                                    {{ $antigo->servico->nome }} - <span class="text-sm font-normal">{{ $antigo->pet->nome }}</span>
                                </h4>
                                <p class="text-xs text-gray-400">
                                    {{ $antigo->data_hora_inicio }} às {{ $antigo->data_hora_inicio }}
                                </p>
                            </div>
                        </div>

                        <span class="text-xs font-semibold px-2 py-1 rounded 
                            {{ $antigo->status == 'cancelado' ? 'bg-red-50 text-red-500' : 'bg-gray-200 text-gray-600' }}">
                            {{ ucfirst($antigo->status) }}
                        </span>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-4">
                {{ $this->historico->links() }}
            </div>
        @endif
    </section>

    {{-- <livewire:agendamento.create /> --}}
</div>