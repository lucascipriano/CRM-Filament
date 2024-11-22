<?php

namespace App\Filament\Widgets;

use App\Models\Consulta;
use App\Models\Filiado;
use App\Models\Mensalidade;
use App\Models\Trabalhos;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalEmCaixaWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Total de consultation_fee das consultas concluídas do usuário logado
        $totalConsultas = Consulta::where('user_id', auth()->id())->sum('consultation_fee');

        // Total de valor dos trabalhos concluídos do usuário logado
        $totalTrabalhos = Trabalhos::where('user_id', auth()->id())
            ->where('concluido', true)
            ->sum('valor');
        $filiadoIds = Filiado::where('user_id', auth()->id())->pluck('id');
        $totalMensalidadesPagas = Mensalidade::whereIn('filiado_id', $filiadoIds)
            ->where('pago', true)
            ->sum('valor');

        // Calculando o total combinado
        $totalEmCaixa = $totalConsultas + $totalTrabalhos + $totalMensalidadesPagas;

        return [
            // Exibindo o total combinado
            Stat::make('Total em caixa', 'R$ ' . number_format($totalEmCaixa, 2, ',', '.'))
                ->icon('heroicon-o-banknotes')
                ->description('Total combinado de consultas e trabalhos.')
                ->color('success'),
        ];
    }
}
