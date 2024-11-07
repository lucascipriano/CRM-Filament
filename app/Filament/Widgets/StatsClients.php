<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsClients extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de clientes',Cliente::count())
                ->icon('heroicon-o-users') // Ícone opcional (use o ícone de sua escolha)
                ->description('Total de clientes cadastrados no sistema'), // Descrição opcional
        ];
    }
}
