<?php

namespace App\Filament\Resources\Nivels\Pages;

use App\Filament\Resources\Nivels\NivelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString;

class ListNivels extends ListRecords
{
    protected static string $resource = NivelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->icon('heroicon-o-plus')
            ->label('Crear Nivel')            
            ->modalHeading(new HtmlString('<span style="color: #ec660c;">NUEVO NIVEL EDUCATIVO</span>'))
            ->disableCreateAnother(), // Opcional: Deshabilita la opción "Crear otro" para simplificar el proceso de creación
        ];
    }
}
