<?php

namespace App\Filament\Widgets;

use App\Models\Consulta;
use App\Models\Despesa;
use App\Models\Filiado;
use App\Models\Mensalidade;
use App\Models\Trabalhos;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDespesas extends BaseWidget
{
    protected function getStats(): array
    {
        // Obtendo o total de despesas do usuário logado
        $totalDespesas = Despesa::where('user_id', auth()->id())->sum('valor');

        // Obtendo o total de despesas do mês atual
        $totalDespesasMes = Despesa::where('user_id', auth()->id())
            ->whereMonth('data_despesa', now()->month)
            ->whereYear('data_despesa', now()->year)
            ->sum('valor');


        //
        // Total de consultas pagas
        $totalConsultas = Consulta::where('user_id', auth()->id())->sum('consultation_fee');

        // Total de trabalhos pagos
        $totalTrabalhos = Trabalhos::where('user_id', auth()->id())
            ->where('concluido', true)
            ->sum('valor');

        // Total de mensalidades pagas
        $totalMensalidades = Mensalidade::where('user_id', auth()->id())
            ->where('pago', true)
            ->sum('valor');

        // Total de despesas
        $totalDespesas = Despesa::where('user_id', auth()->id())->sum('valor');

        // Cálculo do total em caixa
        $totalEmCaixa = ($totalConsultas + $totalTrabalhos + $totalMensalidades) - $totalDespesas;

        //

        return [
            // Stat para o total geral de despesas
            Stat::make('Total de Despesas', 'R$ ' . number_format($totalDespesas, 2, ',', '.'))
                ->icon('heroicon-o-banknotes')
                ->description('Total de todas as despesas.')
                ->color('danger'),

            // Stat para o total de despesas do mês atual
            Stat::make('Despesas deste mês', 'R$ ' . number_format($totalDespesasMes, 2, ',', '.'))
                ->icon('heroicon-o-calendar')
                ->description('Total de despesas no mês atual.')
                ->color('warning'),
            // Total em caixa
            Stat::make('Total em Caixa', 'R$ ' . number_format($totalEmCaixa, 2, ',', '.'))
                ->icon('heroicon-o-banknotes')
                ->description('Receitas menos despesas.')
                ->color($totalEmCaixa >= 0 ? 'success' : 'danger'),
        ];
    }
}
