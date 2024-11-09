<?php

namespace App\Filament\Resources\ConsultaResource\Pages;

use App\Filament\Resources\ConsultaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateConsulta extends CreateRecord
{
    protected static string $resource = ConsultaResource::class;
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
