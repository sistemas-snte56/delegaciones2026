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
            ->modifyQueryUsing(fn ($query) => $query->with(['titular']))
            ->columns([
                TextColumn::make('region.nombre_completo')
                    ->label('REGION'),

                TextColumn::make('nombre_completo')
                    ->label('DELEGACION')
                    ->searchable(['num_delegacional', 'clave_delegacion', 'sede_delegacional'])
                    ->sortable(),

                TextColumn::make('titular.nombre_completo')
                    ->label('titular')
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
                EditAction::make(),
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
