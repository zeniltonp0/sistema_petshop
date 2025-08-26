<div>
    <x-side-bar>
        <x-slot:brand><x-images.logo />
        </x-slot:brand>
        <x-side-bar.separator text="Principal" /> 
            <x-side-bar.item text="Home" icon="home" :route="route('welcome')" wire:navigate/>
            <x-side-bar.item text="Meus Pets" icon="heart" :route="route('pets')" wire:navigate/>
            <x-side-bar.item text="Loja" icon="shopping-bag" route="#" wire:navigate/>
            <x-side-bar.item text="Agendar Serviços" icon="calendar" route="#" wire:navigate/>
        <x-side-bar.separator text="Conta" /> 
    </x-side-bar>
</div>
