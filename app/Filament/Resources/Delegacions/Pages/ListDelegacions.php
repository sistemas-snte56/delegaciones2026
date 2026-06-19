<?php

namespace App\Filament\Resources\Delegacions\Pages;

use App\Filament\Resources\Delegacions\DelegacionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString;

class ListDelegacions extends ListRecords
{
    protected static string $resource = DelegacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->icon('heroicon-o-plus')
            ->label('Crear Delegación')            
            ->disableCreateAnother(), // Opcional: Deshabilita la opción "Crear otro" para simplificar el proceso de creación,
        ];
    }
}
