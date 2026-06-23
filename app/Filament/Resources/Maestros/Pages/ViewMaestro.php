<?php

namespace App\Filament\Resources\Maestros\Pages;

use App\Filament\Resources\Maestros\MaestroResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMaestro extends ViewRecord
{
    protected static string $resource = MaestroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
