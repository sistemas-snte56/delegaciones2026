<?php

namespace App\Filament\Resources\Maestros\Pages;

use App\Filament\Resources\Maestros\MaestroResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMaestro extends EditRecord
{
    protected static string $resource = MaestroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
