<?php

namespace App\Filament\Resources\Secretarias\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SecretariasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('cartera_secretaria')
                    ->searchable(),
                TextColumn::make('tipoDelegacion.tipo')
                    ->searchable(),
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
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->slideOver()
                    ->label('Editar')
                    ->modalHeading('Editar Secretaría')
                    ->modalWidth('md'),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Eliminar seleccionados')
                        ->requiresConfirmation()
                        ->color('danger'),
                ])->label('Acciones múltiples'),
            ])
            ->defaultPaginationPageOption(25);
    }
}
