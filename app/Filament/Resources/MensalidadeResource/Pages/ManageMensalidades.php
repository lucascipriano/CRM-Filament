<?php

namespace App\Filament\Resources\MensalidadeResource\Pages;

use App\Filament\Resources\MensalidadeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMensalidades extends ManageRecords
{
    protected static string $resource = MensalidadeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

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
