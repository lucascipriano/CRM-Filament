<?php

namespace App\Filament\Widgets;

use App\Models\Filiado;
use App\Models\Mensalidade;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsMensalidade extends BaseWidget
{
    protected function getStats(): array
    {

        $filiadoIds = Filiado::where('user_id', auth()->id())->pluck('id');
        $totalMensalidadesPagas = Mensalidade::whereIn('filiado_id', $filiadoIds)
            ->where('pago', true)
            ->sum('valor');
        $totalMensalidadesPendentes = Mensalidade::whereIn('filiado_id', $filiadoIds)
            ->where('pago', false)
            ->sum('valor');


        return [
            // Stat para mensalidades pagas
            Stat::make('Mensalidades Pagas', 'R$ ' . number_format($totalMensalidadesPagas, 2, ',', '.'))
                ->icon('heroicon-o-check-circle')
                ->description('Total de mensalidades pagas.')
                ->color('success'),

            // Stat para mensalidades pendentes
            Stat::make('Mensalidades Pendentes', 'R$ ' . number_format($totalMensalidadesPendentes, 2, ',', '.'))
                ->icon('heroicon-o-exclamation-circle')
                ->description('Total de mensalidades pendentes.')
                ->color('warning'),
        ];

//        // Total de mensalidades pagas do usuário logado
//        $totalMensalidadesPagas = Mensalidade::where('filiado_id', auth()->id())
//            ->where('pago', true)
//            ->sum('valor');
//
//        // Total de mensalidades pendentes do usuário logado
//        $totalMensalidadesPendentes = Mensalidade::where('filiado_id', auth()->id())
//            ->where('pago', false)
//            ->sum('valor');

//        return [
//            // Stat para mensalidades pagas
//            Stat::make('Mensalidades Pagas', 'R$ ' . number_format($totalMensalidadesPagas, 2, ',', '.'))
//                ->icon('heroicon-o-check-circle')
//                ->description('Total de mensalidades pagas.')
//                ->color('success'),
//
//            // Stat para mensalidades pendentes
//            Stat::make('Mensalidades Pendentes', 'R$ ' . number_format($totalMensalidadesPendentes, 2, ',', '.'))
//                ->icon('heroicon-o-exclamation-circle')
//                ->description('Total de mensalidades pendentes.')
//                ->color('warning'),
//        ];
    }
}
