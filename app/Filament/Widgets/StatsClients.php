<?php
namespace App\Filament\Widgets;

use App\Models\Cliente;
use App\Models\Consulta;
use App\Models\Trabalhos;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
class StatsClients extends BaseWidget
{
    protected int | string | array $columnSpan = 3;



    protected function getStats(): array
    {
        return [
            // Total recebido por trabalhos concluídos do usuário logado
            Stat::make('Total recebido por trabalhos', 'R$ ' . number_format(
                    Trabalhos::where('user_id', auth()->id())
                        ->where('concluido', true)
                        ->sum('valor'),
                    2, ',', '.'))
                ->icon('heroicon-o-credit-card')
                ->color('success')
                ->description('Total de valores recebidos pelos trabalhos realizados pelos clientes'),

            // Total recebido por consultas do usuário logado
            Stat::make('Total recebido por consultas', 'R$ ' . number_format(
                    Consulta::where('user_id', auth()->id())
                        ->sum('consultation_fee'),
                    2, ',', '.'))
                ->icon('heroicon-o-credit-card')
                ->color('success')
                ->description('Total de valores recebidos pelas consultas realizadas pelos clientes'),

            // Total pendente a receber de trabalhos do usuário logado
            Stat::make('Total pendente a receber', 'R$ ' . number_format(
                    Trabalhos::where('user_id', auth()->id())
                        ->where('concluido', false)
                        ->sum('valor'),
                    2, ',', '.'))
                ->icon('heroicon-o-credit-card')
                ->description('Valor em espera de trabalhos a serem concluídos.')
                ->color('warning'),
        ];
    }
}
