<?php

namespace App\Filament\Resources\Delegacions\Schemas;

use Filament\Infolists\Components\TextEntry;
// use Filament\Infolists\Components\Section;
// use Filament\Infolists\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class DelegacionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('INFORMACIÓN GENERAL')
                    ->columns(3)
                    ->description('REGIÓN Y PERIODO DE LA DELEGACIÓ O CENTRO DE TRABAJO')
                    ->icon('heroicon-o-building-office-2')                    
                    ->components([
                        TextEntry::make('region.nombre_completo')
                            ->label('REGIÓN')->weight('bold'),

                        TextEntry::make('fecha_inicio_delegacional')
                            ->label('FECHA DE INICIO DEL COMITÉ')
                            ->weight('bold')
                            ->date(),
                            
                            TextEntry::make('fecha_final_delegacional')
                            ->label('FECHA FINAL DEL COMITÉ')
                            ->weight('bold')
                            ->date(),
                    ]),

                Section::make('DATOS PRINCIPALES')
                    ->description('DELEGACIÓN O CENTRO DE TRABAJO')
                    ->icon('heroicon-o-document-text')
                    // ->columnSpanFull()
                    ->columns(1)     
                    ->schema([
                        Grid::make(3)
                            ->schema([
                            
                                TextEntry::make('tipoDelegacion.tipo')
                                    ->label('DELEGACIÓN O CENTRO DE TRABAJO')
                                    ->weight('bold')
                                    ->columnSpan(3), // 👈 ocupa las 3 columnas

                                TextEntry::make('clave_delegacion')
                                    ->label('Centro de trabajo'),

                                TextEntry::make('nivel.nombre')
                                    ->label('Nivel educativo'),

                                TextEntry::make('sede_delegacional')
                                    ->label('Sede'),
                            ]),
                    ]),

                Section::make('Ubicación')
                    ->columns(4)
                    ->components([
                        TextEntry::make('direccion_delegacional')
                            ->label('Dirección')
                            ->columnSpan(2),

                        TextEntry::make('cp_delegacional')
                            ->label('Código postal'),

                        TextEntry::make('ciudad_delegacional')
                            ->label('Municipio'),

                        TextEntry::make('estado_delegacional')
                            ->label('Estado'),
                    ]),

                Section::make()
                    ->columnSpanFull()
                    ->components([
                        TextEntry::make('maestros')
                            ->label('')
                            ->formatStateUsing(fn ($state) =>
                                $state ? null : 'No hay maestros asociados a esta delegación.'
                            )
                            ->color('danger'),
                    ]),
            ]);
    }
}