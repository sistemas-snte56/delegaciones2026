<?php

namespace App\Filament\Resources\Delegacions\RelationManagers;

use App\Filament\Resources\Maestros\MaestroResource;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


use App\Filament\Resources\Maestros\Schemas\MaestroInfolist;
use Filament\Schemas\Schema;

class MaestrosRelationManager extends RelationManager
{
    protected static string $relationship = 'maestros';

    protected static ?string $relatedResource = MaestroResource::class;

    protected static ?string $title = 'Maestros / Dirigentes';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre_completo')
            ->columns([
                TextColumn::make('secretaria.cartera_secretaria')
                    ->label('CARTERA')
                    ->weight('bold')
                    ->searchable()
                    ->color('gray')
                    ->wrap(), // Por si el nombre de la secretaría es muy largo

                // --- NOMBRE COMPLETO (El protagonista de la fila) ---
                TextColumn::make('nombre_completo')
                    ->label('NOMBRE COMPLETO')
                    ->weight('extrabold')
                    ->color('primary')
                    ->searchable(),

                // --- CORREO (Interactivo) ---
                TextColumn::make('email')
                    ->label('CORREO ELECTRÓNICO')
                    ->icon('heroicon-m-envelope')
                    ->iconColor('info')
                    ->copyable() // Permite copiar al portapapeles con un clic
                    ->copyMessage('Correo copiado')
                    ->searchable(),

                // --- TELÉFONO (Con formato e ícono) ---
                TextColumn::make('telefono')
                    ->label('TELÉFONO')
                    ->icon('heroicon-m-phone')
                    ->iconColor('success')
                    ->copyable()
                    ->fontFamily('mono'), // Look numérico limpio

            ])



            ->filters([
            // Aquí puedes meter filtros por nivel o región si fuera necesario
            ])
            // ->headerActions([
            //     // Tus acciones de Crear/Asociar
            // ])
            ->actions([
                // Tus acciones de Editar/Desasociar
                ViewAction::make()->slideOver()
            ])
            ->bulkActions([
                // Acciones en lote
            ])


            
            ->headerActions([
                CreateAction::make()
                    ->slideOver()
                    ->label('Nuevo Maestro'),
            ])
            ->recordActions([
                // ViewAction::make()
                //     ->slideOver()
                //     ->infolist(fn (Schema $schema) => MaestroInfolist::configure($schema)),
                EditAction::make()->slideOver(),
            ])
            ->defaultSort('secretaria_id', 'asc');
    }
}