<?php

namespace App\Filament\Resources\Maestros\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MaestrosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('delegacion.clave_delegacion')
                    ->label('Delegación')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('secretaria.cartera_secretaria')
                    ->label('Cartera')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('nombre_completo')
                    ->label('Nombre Completo')
                    ->searchable(['nombre', 'apaterno', 'amaterno'])
                    ->sortable(),

                TextColumn::make('genero')
                    ->label('Género')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'MASCULINO' => 'info',
                        'FEMENINO'  => 'pink',
                        default     => 'gray',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),

                TextColumn::make('telefono')
                    ->label('Teléfono'),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('delegacion_id')
                    ->relationship('delegacion', 'sede_delegacional')
                    ->label('Filtrar por Delegación')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->nombre_completo)
                    ->searchable()
                    ->preload(),

                SelectFilter::make('genero')
                    ->label('Filtrar por Género')
                    ->options([
                        'MASCULINO' => 'Masculino',
                        'FEMENINO'  => 'Femenino',
                        'OTRO'      => 'Otro',
                    ]),
            ])
            ->recordUrl(null)
            ->recordActions([
                ViewAction::make()->slideOver(),
                EditAction::make()->slideOver(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Eliminar Seleccionados')
                        ->requiresConfirmation()
                        ->modalHeading('¿Eliminar maestros seleccionados?')
                        ->modalSubheading('Esta acción no se puede deshacer.')
                        ->icon('heroicon-o-trash')
                        ->color('danger'),
                ])->label('Acciones en lote'),
            ])
            ->paginated([10, 25, 50, 100])
            ->defaultPaginationPageOption(25)
            ->defaultSort('delegacion.clave_delegacion', 'asc');
    }
}