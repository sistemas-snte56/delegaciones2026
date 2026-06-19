<?php

namespace App\Filament\Resources\Delegacions\Pages;

use App\Filament\Resources\Delegacions\DelegacionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDelegacion extends CreateRecord
{
    protected static string $resource = DelegacionResource::class;

    // 🔁 Redirige al index (tabla)
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
