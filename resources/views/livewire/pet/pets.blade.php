<div>
    <x-table :headers="$this->headers" :rows="$this->rows" filter loading>
        @interact('column_action', $row)
            <x-button.circle
                color="blue"
                md
                flat
                icon="eye"
                wire:click="$dispatch('pets::show', {id : '{{ $row->id }}'})"
            />
        @endinteract
    </x-table>
    <x-button text="Cadastrar novo Pet" class="mt-4" color="secondary" loading wire:click="$dispatch('pets::create')"/>
    <livewire:pet.create />
</div>