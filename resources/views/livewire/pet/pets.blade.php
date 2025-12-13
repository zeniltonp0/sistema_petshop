<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Meus Pets</h2>

        <x-button text="Cadastrar novo Pet" color="secondary" icon="plus" loading
            wire:click="$dispatch('pets::create')" />
    </div>

    @if ($this->rows->isEmpty())
        <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
            <p class="text-gray-500 text-lg">Você ainda não tem pets cadastrados.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($this->rows as $pet)
                <div
                    class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden relative group border border-gray-100">

                    <div
                        class="absolute top-3 right-3 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <x-button.circle color="white" class="text-blue-500 shadow-sm hover:bg-blue-50" icon="pencil"
                            wire:click="$dispatch('pets::edit', {id : '{{ $pet->id }}'})" />
                    </div>

                    <div class="h-48 w-full bg-gray-100 flex items-center justify-center overflow-hidden">
                        @if ($pet->foto_pet)
                            <img src="{{ asset('storage/' . $pet->foto_pet) }}" alt="{{ $pet->nome }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="flex flex-col items-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
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

                            @if ($pet->sexo === 'macho')
                                <span class="bg-blue-100 text-blue-600 p-1.5 rounded-full" title="Macho">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        version="1.0" viewBox="0 0 2816 1536">
                                        <path
                                            d="m1559.7 123.8-10.7.3.2 78.6.3 78.7 118.7.1c65.2 0 118.9.3 119.3.7.4.4-9.8 11-22.7 23.7-12.8 12.6-36.3 36.1-52.3 52.1-15.9 16-48.3 48.3-71.8 71.8l-64.4 64.4c-12 12-22.2 21.8-22.8 21.8-.5 0-2.3-1.2-4-2.5-12.9-10.8-76.8-46.5-92.8-51.9-2.6-.9-7.3-2.7-10.5-4-11.5-4.8-51.1-17.5-65.2-20.9-15.9-3.9-32-6.8-50.5-9.2-6.6-.9-13.3-1.8-15-2-5.7-.9-55.1-3.5-66.3-3.5-13.3 0-45.3 2.4-60.2 4.6-23.5 3.4-64.1 12.4-80.2 17.8-9.3 3.1-14.5 5-35.8 12.9-20.6 7.7-51.5 23.2-79.5 40-11.6 7-27.3 17.7-31.3 21.5-.7.6-3.5 2.6-6 4.4-22 15-50.2 40.9-76 69.8-9.4 10.5-32.4 40.7-40.8 53.6-19.1 29.4-36.7 64.3-52.1 103.4-9.3 23.7-18.4 58.8-23.8 92-5 30.1-5.7 39-6.2 77.5-.5 33.3-.3 38.9 1.6 56 5.3 46.9 16.2 94.4 27.6 121 .7 1.6 4.3 10.6 8.1 20 6.6 16.6 20.8 45.6 28.7 58.5 2.2 3.6 6.2 10.1 8.9 14.5 15.9 26 31.5 46.7 55.3 73.5 14.6 16.3 38.4 38.9 55.1 52 1.7 1.4 7.3 5.9 12.5 10.1 22.8 18.4 55.2 38.3 89.4 54.8 37.4 18.1 93.9 35.9 131.5 41.5 14.1 2.1 36.9 4.7 49.5 5.7 27.9 2.1 70.3 1.4 88.8-1.6 1.2-.2 5.6-.8 9.7-1.4 4.1-.6 12.5-1.8 18.5-2.6 51.6-7.4 123.9-34.2 174.5-64.8 10.2-6.1 37.7-25.1 47.5-32.7 43.1-33.4 84.2-77.5 113.3-121.6 7.6-11.6 22.2-35.6 22.2-36.6 0-.3 2.3-4.5 5.1-9.4 9.2-15.9 26.1-56.1 31.7-75.5 1.7-5.7 4.6-15.8 6.6-22.5 8.1-27.6 12.6-53.2 16.1-91.4 1.9-20.3 2.7-56.7 1.5-67.5-.5-4.4-1.6-15.7-2.5-25.1-1.5-16.2-2.8-25.2-7.4-49.9-3-16-11.1-46-16.5-61.5-1.3-3.6-4-11-5.9-16.5-11.5-32.3-31-71.1-50.4-99.8-5.1-7.6-9.5-14.2-9.8-14.7-.2-.4 38.9-40.1 87.1-88.1 103.4-103.2 140.5-140.4 141.5-142 2.5-4.1 2.8 3.4 2.8 88.4 0 48.5 0 100.9.1 116.4V635h160.9l.1-255.5c0-140.5-.3-255.5-.7-255.6-2.1-.2-491.2-.4-500.6-.1zM1293 583c10 .9 22 2.9 38 6.1 21.7 4.4 57.3 16.8 77.5 27.1 12.8 6.5 34.1 18.8 42.5 24.6 6 4.1 18.8 13.9 20 15.2.3.3 4.1 3.5 8.5 7 20 16 50.9 50.8 64.4 72.7 2.4 3.7 7.2 11.5 10.8 17.3 10.3 16.7 21.2 40.5 27.6 60.5 9.1 28.3 13 43.7 15.1 60.5 4.4 33.6 5 45.5 3.7 66.5-2.4 38.7-7.6 64-21.2 103-11.8 33.8-37 75.5-65.2 108.2-18.3 21.1-34.6 35.6-63.7 56.4-35.9 25.8-78.7 43.9-128.7 54.4-43.5 9.1-106.1 6.6-150.4-6-21.9-6.2-49.5-16.8-67.1-25.6-29.7-14.9-68-43.6-92.9-69.7-16.1-16.8-36.4-43.6-48.3-63.8-8-13.5-22.8-44.6-26.2-54.9-.7-2.2-2.2-6.5-3.3-9.6-4.5-12.5-12.2-45.7-14.7-63.7-4.7-32.6-3.6-73.6 2.7-106.1 4.6-24 13.1-52.3 20.8-69.9 20.7-46.9 44-81.3 77.2-113.7 7.9-7.7 18.2-17.2 22.9-21.1 8.5-7 28.2-21.1 34.9-24.9 2-1.2 5.6-3.4 8.1-5 8-5.1 34.2-18 45.2-22.3 17.8-6.8 44.4-14.9 59.8-18.1 19.8-4.1 27.4-5.1 42.5-5.8 7.2-.3 13.2-.7 13.5-1 .7-.6 34 .6 46 1.7z" />
                                    </svg>
                                </span>
                            @else
                                <span class="bg-pink-100 text-pink-600 p-1.5 rounded-full" title="Fêmea">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5a7 7 0 100 14 7 7 0 000-14zm0 14v5m-3-2h6" />
                                    </svg>
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
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
