<?php

namespace App\Filament\Resources\TrabalhosResource\Pages;

use App\Filament\Resources\TrabalhosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrabalhos extends ListRecords
{
    protected static string $resource = TrabalhosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
