<?php

namespace App\Filament\Resources\Nomenclaturas\Pages;

use App\Filament\Resources\Nomenclaturas\NomenclaturaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNomenclatura extends EditRecord
{
    protected static string $resource = NomenclaturaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
