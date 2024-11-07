<?php

namespace App\Filament\Resources\TrabalhosResource\Pages;

use App\Filament\Resources\TrabalhosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTrabalhos extends CreateRecord
{
    protected static string $resource = TrabalhosResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
