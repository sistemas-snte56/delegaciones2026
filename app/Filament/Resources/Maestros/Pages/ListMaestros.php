<?php

namespace App\Filament\Resources\Maestros\Pages;

use App\Filament\Resources\Maestros\MaestroResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMaestros extends ListRecords
{
    protected static string $resource = MaestroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
