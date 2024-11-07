<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use App\Models\Trabalhos;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsClients extends BaseWidget
{
    protected function getStats(): array
    {
        return array(
            Stat::make('Total de clientes',Cliente::count())
                ->icon('heroicon-o-users')
                ->description('Total de clientes cadastrados no sistema'),
            Stat::make('Total recebido pelos clientes', Trabalhos::where('concluido', true)->sum('valor'))
                ->icon('heroicon-o-credit-card')
                ->color('success')
                ->description('Total de valores recebidos pelos trabalhos realizados pelos clientes'),
            Stat::make('Total a receber dos clientes', Trabalhos::where('concluido', false)->sum('valor'))
                ->icon('heroicon-o-credit-card')
                ->description('Valor em espera de trabalhor a serem concluidos.')
                ->color('danger')
        );
    }


}
