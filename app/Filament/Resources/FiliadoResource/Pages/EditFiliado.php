<?php

namespace App\Filament\Resources\FiliadoResource\Pages;

use App\Filament\Resources\FiliadoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFiliado extends EditRecord
{
    protected static string $resource = FiliadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
