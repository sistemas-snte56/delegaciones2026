<?php

namespace App\Filament\Resources\Nomenclaturas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class NomenclaturasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                textColumn::make('id')
                    ->sortable(),
                TextColumn::make('nomenclatura')
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
                    // ->slideOver()
                    // ->label('Editar')
                    // ->modalHeading('Editar Nomenclatura')
                    // ->modalWidth('md'),
                    ->modalHeading(new HtmlString('<span style="color: #ec660c;">NUEVA NOMENCLATURA</span>')),
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
