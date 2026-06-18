<?php

namespace App\Filament\Resources\Nomenclaturas\Pages;

use App\Filament\Resources\Nomenclaturas\NomenclaturaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString;

class ListNomenclaturas extends ListRecords
{
    protected static string $resource = NomenclaturaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-plus')
                ->label('Crear Nomenclatura')
                //  ->modalHeading('NUEVA NOMNECLATURA')
                ->modalHeading(new HtmlString('<span style="color: #ec660c;">NUEVA NOMENCLATURA</span>'))
                ->disableCreateAnother() // Opcional: Deshabilita la opción "Crear otro" para simplificar el proceso de creación,
        ];
    }
}
