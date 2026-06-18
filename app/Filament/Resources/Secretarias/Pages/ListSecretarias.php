<?php

namespace App\Filament\Resources\Secretarias\Pages;

use App\Filament\Resources\Secretarias\SecretariaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSecretarias extends ListRecords
{
    protected static string $resource = SecretariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->slideOver()
                ->label('Crear nueva Secretaría')
                ->icon('heroicon-o-plus')
                ->modalHeading('Crear Nueva Secretaría')
                ->modalWidth('md')
                ->disableCreateAnother(), // Opcional: Deshabilita la opción "Crear otro" para simplificar el proceso de creación            
        ];
    }
}
