<?php
namespace App\Filament\Pages;

use App\Filament\Widgets\sampleWidget;
use App\Filament\Widgets\StatsClients;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    protected static ?string $title = 'Bem-vindo'; // Título padrão
    protected static string $view = 'filament.pages.dashboard';

    public function getTitle(): string
    {
        // Obtém o nome do usuário logado
        $userName = auth()->user()->name;
        return "Bem-vindo, {$userName}"; // Modifica o título para incluir o nome do usuário
    }


    protected static ?string $navigationLabel = 'Início';

    public function filtersForm(Form $form): Form
    {
        return $form->schema([
        ]);
    }


}
