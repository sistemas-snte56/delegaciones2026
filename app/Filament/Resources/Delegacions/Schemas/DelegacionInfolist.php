<?php

namespace App\Filament\Resources\Delegacions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs; // 👈 Importamos Tabs
use Filament\Schemas\Components\Tabs\Tab; // 👈 Importamos Tab

class DelegacionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('INFORMACIÓN GENERAL')
                    ->description('Gestión y consulta de datos de la delegación o centro de trabajo')
                    ->icon('heroicon-o-building-office-2')  
                    ->columnSpanFull()
                    ->columns(1)               
                    ->schema([
                        
                        Tabs::make('Detalles')
                            ->columnSpanFull()
                            ->tabs([
                                
                                // --- PESTAÑA 1: VIGENCIA Y GENERAL ---
                                Tab::make('Vigencia y Periodo')
                                    ->icon('heroicon-m-calendar-days')
                                    ->columns(3)
                                    ->schema([
                                        TextEntry::make('region.nombre_completo')
                                            ->label('REGIÓN')
                                            ->weight('extrabold')
                                            ->badge()
                                            ->color('info')
                                            ->icon('heroicon-m-map-pin'),

                                        TextEntry::make('fecha_inicio_delegacional')
                                            ->label('INICIO DEL COMITÉ')
                                            ->weight('bold')
                                            ->badge()
                                            ->color('success')
                                            ->icon('heroicon-m-calendar-days')
                                            ->date('d/m/Y'),
                                            
                                        TextEntry::make('fecha_final_delegacional')
                                            ->label('FINAL DEL COMITÉ')
                                            ->weight('bold')
                                            ->badge()
                                            ->color('danger')
                                            ->icon('heroicon-m-calendar-days')
                                            ->date('d/m/Y'),
                                    ]),

                                // --- PESTAÑA 2: IDENTIFICACIÓN ---
                                Tab::make('Datos Principales')
                                    ->icon('heroicon-m-identification')
                                    ->columns(3)
                                    ->schema([
                                        TextEntry::make('tipoDelegacion.tipo')
                                            ->label('TIPO DE CENTRO DE TRABAJO')
                                            ->weight('extrabold')
                                            ->columnSpanFull()
                                            ->color('primary'),

                                        TextEntry::make('clave_delegacion')
                                            ->label('CLAVE DELEGACIONAL')
                                            ->weight('extrabold')
                                            ->fontFamily('mono')
                                            ->copyable()
                                            ->icon('heroicon-m-tag')
                                            ->iconColor('warning'),

                                        TextEntry::make('nivel.nombre')
                                            ->label('NIVEL EDUCATIVO')
                                            ->weight('bold')
                                            ->badge()
                                            ->color('gray'),

                                        TextEntry::make('sede_delegacional')
                                            ->label('SEDE O LOCALIDAD')
                                            ->weight('semibold')
                                            ->icon('heroicon-m-map'),
                                    ]),

                                // --- PESTAÑA 3: UBICACIÓN ---
                                Tab::make('Ubicación Geográfica')
                                    ->icon('heroicon-m-map-pin')
                                    ->columns(3)
                                    ->schema([
                                        TextEntry::make('direccion_delegacional')
                                            ->label('DIRECCIÓN COMPLETA')
                                            ->weight('medium')
                                            ->columnSpanFull(),
                
                                        TextEntry::make('cp_delegacional')
                                            ->label('CÓDIGO POSTAL')
                                            ->fontFamily('mono'),
                
                                        TextEntry::make('ciudad_delegacional')
                                            ->label('MUNICIPIO')
                                            ->weight('semibold'),
                
                                        TextEntry::make('estado_delegacional')
                                            ->label('ESTADO')
                                            ->weight('semibold'),
                                    ]),

                            ]), // Fin de Tabs

                    ]), // Fin de Section

            ]);
    }
}