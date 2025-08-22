<div>
    <x-side-bar>
        <x-slot:brand>Logo</x-slot:brand>
        <x-side-bar.separator text="Principal" /> 
            <x-side-bar.item text="Home" icon="home" :route="route('welcome')" />
            <x-side-bar.item text="Meus Pets" icon="heart" route="#" />
            <x-side-bar.item text="Loja" icon="shopping-bag" route="#" />
            <x-side-bar.item text="Agendar Serviços" icon="calendar" route="#" />
        <x-side-bar.separator text="Conta" /> 
    </x-side-bar>
</div>