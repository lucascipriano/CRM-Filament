{{-- resources/views/filament/pages/dashboard.blade.php --}}
<x-filament::page>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        <p>Controle entrada serviços</p>
        @livewire(\App\Filament\Widgets\StatsClients::class)
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        <p>Controle entrada internos</p>
        @livewire(\App\Filament\Widgets\StatsMensalidade::class)
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        <p>Controle Total em caixa</p>
        @livewire(\App\Filament\Widgets\StatsDespesas::class)
    </div>
</x-filament::page>
