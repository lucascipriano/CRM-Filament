<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use App\Models\Trabalhos;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class statsentry extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total recebido pelos clientes', Trabalhos::where('concluido', true)->sum('valor'))
                ->icon('heroicon-o-credit-card') // Ícone representando transações
                ->description('Total de valores recebidos pelos trabalhos realizados pelos clientes'),

            ];
    }
}
