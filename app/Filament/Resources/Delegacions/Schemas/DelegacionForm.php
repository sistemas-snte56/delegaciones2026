<?php

namespace App\Filament\Resources\Delegacions\Schemas;

use App\Models\Nomenclatura;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DelegacionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la Delegación')
                    ->description('Datos principales de información de la delegación')
                    ->icon('heroicon-o-building-office-2')
                    ->schema([
                        Select::make('region_id')
                            ->label('Región')
                            ->relationship('region', 'region')
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (callable $set) => $set('tipo_delegacion_id', null)),

                        Select::make('tipo_delegacion_id')
                            ->label('Tipo de Delegación')
                            ->relationship('tipoDelegacion', 'tipo')
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (callable $set) => $set('nomenclatura_id', null)),

                        Select::make('nomenclatura_id')
                            ->label('Nomenclatura')
                            ->options(function (callable $get) {
                                $tipoId = $get('tipo_delegacion_id');
                                if (! $tipoId) return [];
                                return Nomenclatura::where('tipo_delegacion_id', $tipoId)
                                    ->pluck('nomenclatura', 'id');
                            })
                            ->required()
                            ->live(),

                        TextInput::make('num_delegacional')
                            ->label('Número Delegacional')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(999),

                        Select::make('nivel_id')
                            ->label('Nivel')
                            ->relationship('nivel', 'nombre')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('sede_delegacional')
                            ->label('Sede')
                            ->required()
                            ->maxLength(150)
                            ->afterStateUpdated(function ($state, callable $set) {
                                    $set('sede_delegacional', mb_strtoupper($state, 'UTF-8'));
                                }),
                    ])->columns(2),

                Section::make('Vigencia')
                    ->description('Período de la delegación')
                    ->icon('heroicon-o-calendar')
                    ->schema([
                        DatePicker::make('fecha_inicio_delegacional')
                            ->label('Fecha Inicio')
                            ->required()
                            ->native(false),
                        DatePicker::make('fecha_final_delegacional')
                            ->label('Fecha Final')
                            ->required()
                            ->native(false),
                    ])->columns(2),

                Section::make('Domicilio')
                    ->description('Datos de ubicación opcionales')
                    ->icon('heroicon-o-map-pin')
                    ->collapsed()
                    ->schema([
                        TextInput::make('direccion_delegacional')
                            ->label('Dirección')
                            ->maxLength(250),
                        TextInput::make('cp_delegacional')
                            ->label('Código Postal')
                            ->maxLength(10),
                        TextInput::make('ciudad_delegacional')
                            ->label('Ciudad')
                            ->maxLength(150),
                        TextInput::make('estado_delegacional')
                            ->label('Estado')
                            ->maxLength(150),
                    ])->columns(2),
            ]);
    }
}