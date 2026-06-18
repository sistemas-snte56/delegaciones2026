<?php

namespace App\Filament\Resources\TipoDelegacions\Pages;

use App\Filament\Resources\TipoDelegacions\TipoDelegacionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTipoDelegacion extends EditRecord
{
    protected static string $resource = TipoDelegacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
