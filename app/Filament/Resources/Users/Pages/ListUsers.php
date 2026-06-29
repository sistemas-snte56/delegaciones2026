<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
// use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

use Filament\Actions\Action;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Models\User;
use Filament\Support\Icons\Heroicon;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
            Action::make('create')
                ->label('Crear user')
                ->icon(Heroicon::UserPlus)
                ->form(fn ($form) => UserForm::configure($form))
                ->action(function (array $data) {
                    User::create($data);
                }),
        ];
    }
}
