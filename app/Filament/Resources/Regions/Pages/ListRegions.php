<?php

namespace App\Filament\Resources\Regions\Pages;

use App\Filament\Resources\Regions\RegionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRegions extends ListRecords
{
    protected static string $resource = RegionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->slideOver()
                ->label('Crear nueva región')
                ->icon('heroicon-o-plus')
                ->modalHeading('Crear Nueva Región')
                ->modalWidth('md')
                ->disableCreateAnother() // Opcional: Deshabilita la opción "Crear otro" para simplificar el proceso de creación
        ];
    }
}
