<?php

namespace App\Filament\Resources\Delegacions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Filament\Tables\Filters\SelectFilter;

class DelegacionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('region.nombre_completo')
                    ->label('REGION'),

                TextColumn::make('nombre_completo')
                    ->label('DELEGACION')
                    ->searchable(['num_delegacional', 'clave_delegacion', 'sede_delegacional'])
                    ->sortable(),

                TextColumn::make('titular_delegacion') // Nombre ficticio para que no se confunda Filament
                    ->label('MAESTRO / TITULAR')
                    ->getStateUsing(function ($record) {
                        // Buscamos en la base de datos al primer maestro de esta delegación
                        return $record->maestros()
                            // filtramos a través de la relación 'secretaria' que debe tener tu modelo Maestro
                            ->whereHas('secretaria', function ($query) {
                                $query->whereIn('cartera_secretaria', [ // 👈 Cambia 'cartera' por el nombre de la columna real en tu tabla 'secretarias' (puede ser 'nombre', 'puesto', etc.)
                                    'SECRETARÍA GENERAL', 
                                    'REPRESENTANTE SINDICAL DE CENTRO DE TRABAJO'
                                ]);
                            })
                            ->first()?->nombre_completo; // Tu accessor en Maestro.php
                    })
                    ->searchable(['nombre','apaterno','amaterno'])
                    ->placeholder('Sin asignar'),

                TextColumn::make('fecha_inicio_delegacional')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('fecha_final_delegacional')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)                    
                    ->sortable(),

            ])            
            ->filters([
                SelectFilter::make('region_id')
                    ->relationship('region', 'region')
                    ->label('Filtrar por Región')
                    ->placeholder('Selecciona una región')
                    ->getOptionLabelFromRecordUsing(fn ($record) =>
                            "{$record->region} - {$record->sede}"
                        ),
            ])
            // ->recordUrl(null)
            // ->recordUrl(fn ($record) => \App\Filament\Resources\Delegacions\DelegacionResource::getUrl('view', ['record' => $record]))
            ->recordActions([
                EditAction::make()->slideOver(),
            ])
                
            ->actions([
                ViewAction::make(),
            ])
            
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Eliminar Seleccionados')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('¿Estás seguro de que deseas eliminar las delegaciones seleccionadas?')
                        ->modalSubheading('Esta acción no se puede deshacer.')
                        ->icon('heroicon-o-trash'),
                ])->label('Acciones en lote'),
            ])
            ->paginated([10, 25, 50, 100])
            ->defaultPaginationPageOption(50)
            ->defaultSort('clave_delegacion','asc')            
            ;
    }
}
