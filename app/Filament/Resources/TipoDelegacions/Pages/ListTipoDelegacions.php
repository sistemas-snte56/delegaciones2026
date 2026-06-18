<?php

namespace App\Filament\Resources\TipoDelegacions\Pages;

use App\Filament\Resources\TipoDelegacions\TipoDelegacionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTipoDelegacions extends ListRecords
{
    protected static string $resource = TipoDelegacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->slideOver()
                ->label('Crear nuevo tipo de delegación')
                ->icon('heroicon-o-plus')
                ->modalHeading('Crear Nuevo Tipo de Delegación')
                ->modalWidth('md')
                ->disableCreateAnother(), // Opcional: Deshabilita la opción "Crear otro" para simplificar el proceso de creación,
        ];
    }
}
