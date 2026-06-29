<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Users\Schemas\UserForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;


class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('NOMBRE')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('CORREO ELECTRONICO')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('ROL ASIGNADO')
                    ->badge()
                    ->colors([
                        'danger' => 'admin',
                        'warning' => 'coordinador',
                        'success' => 'gestor',
                    ]),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->label('Filtrar por Rol')
                    ->relationship('roles','name'),
            ])
            ->headerActions([
                    
            ])
            ->recordActions([
                // EditAction::make()->slideOver(),
                EditAction::make()
                    ->icon(Heroicon::Pencil)
                    ->modal()
                    ->form(fn ($form) => UserForm::configure($form))
                    ->fillForm(fn ($record) => $record->toArray())
                    ->action(function ($record, array $data) {
                        $record->update($data);
                    })
                    ->successNotificationTitle('User actualizado correctamente')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Eliminar seleccionados')
                        ->requiresConfirmation()
                        ->color('danger'),
                ])->label('Acciones múltiples'),
            ]);

    }
}
