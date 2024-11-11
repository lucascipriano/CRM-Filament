<?php

namespace App\Filament\Resources\FiliadoResource\Pages;

use App\Filament\Resources\FiliadoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFiliado extends CreateRecord
{
    protected static string $resource = FiliadoResource::class;

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
