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
                    #->aside() // Esto pone el título a la izquierda y el contenido a la derecha
                    ->icon('heroicon-o-building-office-2')  
                    ->columnSpanFull()                  
                    ->components([
                        TextEntry::make('region.nombre_completo')
                            ->label('REGIÓN')
                            ->weight('bold')
                            ->badge()
                            ->color('info')
                            ->icon('heroicon-m-map-pin')
                            ,

                        TextEntry::make('fecha_inicio_delegacional')
                            ->label('INICIO DEL COMITÉ')
                            ->weight('bold')
                            ->badge()
                            ->color('info')
                            ->icon('heroicon-s-calendar')
                            ->date()
                            ->extraAttributes([
                                    'class' => 'px-3 py-1 gap-2'
                                ]),
                            
                            TextEntry::make('fecha_final_delegacional')
                            ->label('FINAL DEL COMITÉ')
                            ->weight('bold')
                            ->badge()
                            ->color('info')
                            ->icon('heroicon-s-calendar')
                            ->date(),
                    ]),

                Section::make('DATOS PRINCIPALES')
                    ->description('DELEGACIÓN O CENTRO DE TRABAJO')
                    ->icon('heroicon-o-document-text')
                    ->columnSpanFull()
                    ->columns(1)     
                    ->schema([
                        Grid::make(3)
                            ->schema([
                            
                                TextEntry::make('tipoDelegacion.tipo')
                                    ->label('DELEGACIÓN O CENTRO DE TRABAJO')
                                    ->weight('bold')
                                    ->columnSpan(3), // 👈 ocupa las 3 columnas

                                TextEntry::make('clave_delegacion')
                                    ->label('DELEGACIÓN')
                                    ->copyable()
                                    ->icon('heroicon-m-tag'),

                                TextEntry::make('nivel.nombre')
                                    ->label('Nivel educativo'),

                                TextEntry::make('sede_delegacional')
                                    ->label('Sede'),
                            ]),
                    ]),

                Section::make('UBICACIÓN')
                    ->description('DETALLES DE LA UBICACIÓN DELEGACIONAL')
                    ->icon('heroicon-m-map-pin')
                    ->columnSpanFull()
                    ->columns(1)
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('direccion_delegacional')
                                    ->label('Dirección')
                                    ->columnSpan(3),
        
                                TextEntry::make('cp_delegacional')
                                    ->label('Código postal'),
        
                                TextEntry::make('ciudad_delegacional')
                                    ->label('Municipio'),
        
                                TextEntry::make('estado_delegacional')
                                    ->label('Estado'),
                            ])
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