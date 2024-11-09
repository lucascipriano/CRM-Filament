<?php

namespace App\Filament\Resources\FiliadoResource\Pages;

use App\Filament\Resources\FiliadoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFiliados extends ListRecords
{
    protected static string $resource = FiliadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
