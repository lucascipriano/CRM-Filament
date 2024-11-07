<?php

namespace App\Filament\Resources\TrabalhosResource\Pages;

use App\Filament\Resources\TrabalhosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrabalhos extends EditRecord
{
    protected static string $resource = TrabalhosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
