<?php

namespace App\Filament\Resources\Regions\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RegionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la Región')
                    ->icon('heroicon-o-map-pin')
                    ->columnSpanFull() // 1. Fuerza a la sección a estirarse horizontalmente al 100%
                    ->columns(1)       // 2. Establece que dentro de la sección el flujo sea de una columna completa
                    ->schema([
                        TextInput::make('region')
                            ->label('Región')
                            ->required()
                            ->maxLength(150)
                            ->columnSpanFull(), // 3. Estira el input de región

                        TextInput::make('sede')
                            ->label('Sede')
                            ->required()
                            ->maxLength(150)
                            ->columnSpanFull(), // 4. Estira el input de sede
                    ]),
            ]);
    }
}
