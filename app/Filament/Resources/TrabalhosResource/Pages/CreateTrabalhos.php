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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Adiciona o user_id aos dados do formulário antes de salvar
        $data['user_id'] = auth()->id();
        return $data;
    }
}
